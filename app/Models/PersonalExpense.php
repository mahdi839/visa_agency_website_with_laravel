<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalExpense extends Model
{
    protected $fillable = [
        'purpose',
        'amount',
        'document',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }
}
