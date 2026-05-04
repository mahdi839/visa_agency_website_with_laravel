<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public static function fallbackCollection(): Collection
    {
        return collect([
            (object) ['title' => 'Schengen Visa', 'icon' => 'SV', 'description' => 'Travel across Europe with a complete visa file prepared by our expert team.'],
            (object) ['title' => 'Work Permit', 'icon' => 'WP', 'description' => 'Secure your legal right to work in Spain or other EU countries with properly prepared documentation.'],
            (object) ['title' => 'Student Visa', 'icon' => 'ST', 'description' => 'Study at European universities with support for enrollment, financial proofs, and visa applications.'],
            (object) ['title' => 'Family Reunification', 'icon' => 'FR', 'description' => 'Bring your family to Europe with careful handling for spouse and dependent visa files.'],
            (object) ['title' => 'Business Visa', 'icon' => 'BV', 'description' => 'Attend meetings, conferences, or explore business opportunities with a properly processed business visa.'],
            (object) ['title' => 'Document Consulting', 'icon' => 'DC', 'description' => 'Get a tailored document checklist and expert review before your application is submitted.'],
        ]);
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug ?: Str::random(8);
        $counter = 2;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
