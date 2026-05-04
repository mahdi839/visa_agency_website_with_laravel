<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadMessage extends Model
{
    protected $fillable = [
        'message_thread_id',
        'sender_id',
        'body',
        'is_admin',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'is_admin' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(MessageThread::class, 'message_thread_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
