<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'subject',
    'country',
    'description',
    'document_path',
    'note',
    'urgency',
    'status',
    'update_message',
    'update_message_at',
])]
class VisaApplication extends Model
{
    use HasFactory;

    public const SUBJECTS = [
        'travel_ticket' => 'Travel Ticket',
        'visa_application' => 'Application for Visa',
        'information' => 'Just Getting Information',
    ];

    public const URGENCIES = [
        'normal' => 'Normal',
        'urgent' => 'Urgent',
        'very_urgent' => 'Very Urgent',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'progress' => 'Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    protected function casts(): array
    {
        return [
            'update_message_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
