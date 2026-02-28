<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manifesto extends Model
{
    protected $fillable = [
        'party_id', 'title', 'summary', 'full_text',
        'published_date', 'pdf_url', 'key_points'
    ];

    protected $casts = [
        'key_points' => 'array',
        'published_date' => 'date',
    ];

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
}
