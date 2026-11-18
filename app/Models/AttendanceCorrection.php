<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceCorrection extends Model
{
    protected $table = 'attendance_corrections';

    protected $fillable = [
        'attendance_id',
        'reason',
        'requested_check_in',
        'requested_check_out',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_notes',
    ];

    protected $casts = [
        'requested_check_in' => 'datetime',
        'requested_check_out' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function attendance(): BelongsTo
    {
        return $this->belongsTo(
            Attendance::class,
            'attendance_id'
        );
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
