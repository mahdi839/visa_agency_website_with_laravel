<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'hero_label',
    'title',
    'subtitle',
    'story_title',
    'story_body',
    'mission_title',
    'mission_body',
    'is_published',
])]
class AboutUs extends Model
{
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }
}
