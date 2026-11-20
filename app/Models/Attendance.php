<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    protected $table = 'attendances';

    
    protected $fillable = [
        'internship_applicant_id',
        'schedule_id',
        'check_in_at',
        'check_out_at',
        'check_in_latitude',
        'check_in_longitude',
        'check_in_accuracy',
        'check_out_latitude',
        'check_out_longitude',
        'check_out_accuracy',
        'status',
        'notes',
    ];

    protected $casts = [
        'check_in_at' => 'datetime',
        'check_out_at' => 'datetime',
    ];


    public function applicant(): BelongsTo
    {
        return $this->belongsTo(
            InternshipApplicant::class,
            'internship_applicant_id'
        );
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(
            AttendanceSchedule::class,
            'schedule_id'
        );
    }

    public function corrections(): HasMany
    {
        return $this->hasMany(
            AttendanceCorrection::class,
            'attendance_id'
        );
    }
}
