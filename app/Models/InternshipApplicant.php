<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternshipApplicant extends Model
{
    protected $table = 'internship_applicants';

    public function internAccount(): HasOne
    {
        return $this->hasOne(UserIntern::class, 'applicant_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'internship_applicant_id');
    }

    public function attendanceRequests(): HasMany
    {
        return $this->hasMany(AttendanceRequest::class, 'internship_applicant_id');
    }

    public function internshipRequest(): BelongsTo
    {
        return $this->belongsTo(
            InternshipRequest::class,
            'internship_request_id'
        );
    }
}
