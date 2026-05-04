<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageThread extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'status',
        'last_message_at',
    ];

    public const STATUSES = [
        'open' => 'Open',
        'closed' => 'Closed',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ThreadMessage::class, 'message_thread_id');
    }
}
