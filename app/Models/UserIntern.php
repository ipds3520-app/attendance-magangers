<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserIntern extends Authenticatable
{
    protected $table = 'users_intern';

    protected $fillable = [
        'applicant_id',
        'registration_token_id',
        'name',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(
            InternshipApplicant::class,
            'applicant_id'
        );
    }
}
