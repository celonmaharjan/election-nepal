<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    protected $fillable = [
        'candidate_id', 'constituency_id', 'votes_received',
        'vote_percentage', 'rank', 'is_winner', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_winner' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function constituency(): BelongsTo
    {
        return $this->belongsTo(Constituency::class);
    }
}
