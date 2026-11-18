<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceRequest extends Model
{
    protected $table = 'attendance_requests';

    protected $fillable = [
        'internship_applicant_id',
        'request_type',
        'start_date',
        'end_date',
        'reason',
        'attachment_url',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(
            InternshipApplicant::class,
            'internship_applicant_id'
        );
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
