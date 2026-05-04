<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];

    public const STATUSES = [
        'new' => 'New',
        'read' => 'Read',
        'archived' => 'Archived',
    ];
}
