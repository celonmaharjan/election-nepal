<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Constituency extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'number', 'province_id', 'district', 
        'type', 'total_voters', 'description'
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'district' => $this->district,
            'province' => $this->province->name ?? '',
        ];
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
