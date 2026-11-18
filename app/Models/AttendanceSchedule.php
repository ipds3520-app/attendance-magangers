<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceSchedule extends Model
{
    protected $table = 'attendance_schedules';

    protected $fillable = [
        'schedule_name',
        'schedule_date',
        'start_time',
        'end_time',
        'late_tolerance',
        'office_latitude',
        'office_longitude',
        'allowed_radius',
        'is_active',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'is_active' => 'boolean',
        'late_tolerance' => 'integer',
        'allowed_radius' => 'integer',
    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'schedule_id');
    }
}
