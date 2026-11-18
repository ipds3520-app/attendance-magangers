<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternshipRequest extends Model
{
    protected $table = 'internship_requests';

    protected $fillable = [
        'institution_id',
        'created_by',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'processed_by',
        'decided_at',
        'reply_letter_path',
        'letter_number',
        'admin_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'decided_at' => 'datetime',
    ];

    public function applicants(): HasMany
    {
        return $this->hasMany(
            InternshipApplicant::class,
            'internship_request_id'
        );
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(
            Institution::class,
            'institution_id'
        );
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'processed_by'
        );
    }
}
