<?php

namespace App\Http\Controllers;

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

        // Periksa kembali kelayakan peserta
        $message = $this->getEligibilityError($intern);

        if ($message !== null) {
            Auth::guard('intern')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('intern.login')
                ->withErrors(['email' => $message]);
        }

        return view('intern.dashboard', compact('intern'));
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

    // Logout peserta
    public function logout(Request $request)
    {
        Auth::guard('intern')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('intern.login');
    }
}
