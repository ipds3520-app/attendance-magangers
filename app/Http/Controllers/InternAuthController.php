<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class InternAuthController extends Controller
{
    // Menampilkan halaman login peserta
    public function showLogin()
    {
        if (Auth::guard('intern')->check()) {
            return redirect()->route('intern.dashboard');
        }

        return view('intern.login');
    }

    // Memproses login peserta
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('intern')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password yang kamu masukkan salah.',
            ]);
        }

        $request->session()->regenerate();

        $intern = Auth::guard('intern')->user();

        // Periksa kelayakan peserta
        $message = $this->getEligibilityError($intern);

        if ($message !== null) {
            Auth::guard('intern')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('intern.login')
                ->withErrors(['email' => $message]);
        }

        return redirect()->route('intern.dashboard');
    }

    // Dashboard peserta
    public function dashboard(Request $request)
    {
        $intern = Auth::guard('intern')->user();

        $message = $this->getEligibilityError($intern);

        if ($message !== null) {
            Auth::guard('intern')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('intern.login')
                ->withErrors(['email' => $message]);
        }

        // Ambil jadwal absensi hari ini
        $schedule = AttendanceSchedule::whereDate(
            'schedule_date',
            today()
        )
            ->where('is_active', true)
            ->first();

        // Siapkan variabel attendance
        $attendance = null;

        // Ambil data presensi peserta jika jadwal tersedia
        if ($schedule) {
            $attendance = Attendance::where(
                'internship_applicant_id',
                $intern->applicant_id
            )
                ->where('schedule_id', $schedule->id)
                ->first();
        }

        // Kirim data ke dashboard
        return view('intern.dashboard', compact(
            'intern',
            'schedule',
            'attendance'
        ));
    }


    // Memproses check-in peserta
    public function checkIn(Request $request)
    {
        $intern = Auth::guard('intern')->user();

        // Periksa kelayakan peserta
        $message = $this->getEligibilityError($intern);

        if ($message !== null) {
            return redirect()
                ->route('intern.login')
                ->withErrors(['email' => $message]);
        }

        // Validasi koordinat GPS
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accuracy' => ['nullable', 'numeric', 'min:0'],
        ]);

        // Ambil jadwal aktif hari ini
        $schedule = AttendanceSchedule::whereDate(
            'schedule_date',
            today()
        )
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return back()->with('error', 'Jadwal absensi tidak tersedia.');
        }

        // Hitung jarak peserta dengan kantor
        $distance = $this->calculateDistance(
            (float) $validated['latitude'],
            (float) $validated['longitude'],
            (float) $schedule->office_latitude,
            (float) $schedule->office_longitude
        );

        // Periksa radius lokasi
        if ($distance > $schedule->allowed_radius) {
            return back()->with(
                'error',
                'Kamu berada di luar radius presensi. Jarak kamu sekitar '
                . round($distance, 2) . ' meter.'
            );
        }

        // Periksa apakah peserta sudah check-in
        $existingAttendance = Attendance::where(
            'internship_applicant_id',
            $intern->applicant_id
        )
            ->where('schedule_id', $schedule->id)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Kamu sudah melakukan check-in.');
        }

    // Tentukan status kehadiran
        $deadline = \Illuminate\Support\Carbon::parse(
            $schedule->schedule_date->toDateString()
            . ' ' . $schedule->start_time
        )->addMinutes($schedule->late_tolerance);

        $status = now()->greaterThan($deadline)
            ? 'late'
            : 'present';

    // Simpan data absensi
        Attendance::create([
            'internship_applicant_id' => $intern->applicant_id,
            'schedule_id' => $schedule->id,
            'check_in_at' => now(),
            'check_in_latitude' => $validated['latitude'],
            'check_in_longitude' => $validated['longitude'],
            'check_in_accuracy' => $validated['accuracy'] ?? null,
            'status' => $status,
        ]);

        return back()->with(
            'success',
            'Check-in berhasil! Status kehadiran: ' . $status
        );
    }


    // Memproses check-out peserta
    public function checkOut(Request $request)
    {
        $intern = Auth::guard('intern')->user();

        // Periksa kelayakan peserta magang
        $message = $this->getEligibilityError($intern);

        if ($message !== null) {
            return redirect()
                ->route('intern.login')
                ->withErrors(['email' => $message]);
        }

        // Validasi koordinat GPS
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accuracy' => ['nullable', 'numeric', 'min:0'],
        ]);

        // Ambil jadwal aktif hari ini
        $schedule = AttendanceSchedule::whereDate(
            'schedule_date',
            today()
        )
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return back()->with(
                'error',
                'Jadwal absensi tidak tersedia.'
            );
        }

        // Cari data check-in peserta
        $attendance = Attendance::where(
            'internship_applicant_id',
            $intern->applicant_id
        )
            ->where('schedule_id', $schedule->id)
            ->first();

        if (!$attendance || !$attendance->check_in_at) {
            return back()->with(
                'error',
                'Kamu belum melakukan check-in.'
            );
        }

        // Periksa apakah sudah check-out
        if ($attendance->check_out_at) {
            return back()->with(
                'error',
                'Kamu sudah melakukan check-out.'
            );
        }

        // Hitung jarak peserta dengan kantor
        $distance = $this->calculateDistance(
            (float) $validated['latitude'],
            (float) $validated['longitude'],
            (float) $schedule->office_latitude,
            (float) $schedule->office_longitude
        );

        // Periksa radius lokasi
        if ($distance > $schedule->allowed_radius) {
            return back()->with(
                'error',
                'Kamu berada di luar radius presensi. Jarak kamu sekitar '
                . round($distance, 2) . ' meter.'
            );
        }

        // Simpan data check-out
        $attendance->update([
            'check_out_at' => now(),
            'check_out_latitude' => $validated['latitude'],
            'check_out_longitude' => $validated['longitude'],
            'check_out_accuracy' => $validated['accuracy'] ?? null,
        ]);

        return back()->with(
            'success',
            'Check-out berhasil! Sampai jumpa besok.'
        );
    }


    // Memeriksa kelayakan peserta magang
    private function getEligibilityError($intern): ?string
    {
        // Ambil data applicant dan pengajuan magang
        $intern->loadMissing('applicant.internshipRequest');

        $applicant = $intern->applicant;
        $internshipRequest = $applicant?->internshipRequest;

        // Pastikan data pengajuan tersedia
        if (!$internshipRequest) {
            return 'Data pengajuan magang tidak ditemukan.';
        }

        // Periksa status pengajuan
        if ($internshipRequest->status !== 'approved') {
            return 'Pengajuan magang kamu belum disetujui.';
        }

        // Periksa periode magang
        $startDate = $internshipRequest->start_date?->toDateString();
        $endDate = $internshipRequest->end_date?->toDateString();

        if (!$startDate || !$endDate) {
            return 'Periode magang belum tersedia.';
        }

        $today = now()->toDateString();

        if ($today < $startDate) {
            return 'Masa magang kamu belum dimulai.';
        }

        if ($today > $endDate) {
            return 'Masa magang kamu sudah berakhir.';
        }

        // Peserta memenuhi seluruh persyaratan
        return null;
    }

    // Menghitung jarak antara lokasi peserta dan kantor
    private function calculateDistance(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {
        $earthRadius = 6371000; // meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1))
            * cos(deg2rad($lat2))
            * sin($dLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    // Logout peserta
    public function logout(Request $request)
    {
        Auth::guard('intern')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('intern.login');
    }
}
