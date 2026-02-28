<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsArticle extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'content', 'source',
        'source_url', 'image', 'published_at', 'category',
        'tags', 'is_featured'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title) . '-' . Str::random(5);
            }
        });
    }
}
