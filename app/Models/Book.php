<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'description',
        'price',
        'is_available',
        'tags',
        'document',
        'pages',
        'visits',
        'picture'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_available' => 'boolean',
        'pages' => 'integer',
        'visits' => 'integer',
    ];

    public function scopeFilterByPrice(Builder $query, string $range): Builder
    {
        if ($range === '30+')
            return $query->where(
                'price',
                '>=',
                30
            );

        [$min, $max] = explode('-', $range);
        return $query->whereBetween(
            'price',
            [(float) $min, (float) $max]
        );
    }

    public function scopeFilterByTags(Builder $query, array $tags): Builder
    {
        return $query->where(function (Builder $q) use ($tags) {
            foreach ($tags as $tag) {
                $q->orWhereJsonContains('tags', trim($tag));
            }
        });
    }
}
