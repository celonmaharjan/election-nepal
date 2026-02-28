<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Candidate extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'name_nepali', 'photo', 'party_id', 'constituency_id',
        'age', 'gender', 'education_level', 'education_details',
        'occupation', 'address', 'criminal_cases', 'assets_declared',
        'manifesto_summary', 'detailed_manifesto', 'social_links',
        'website', 'previous_election_result', 'is_incumbent', 'slug'
    ];

    protected $casts = [
        'assets_declared' => 'array',
        'social_links' => 'array',
        'previous_election_result' => 'array',
        'is_incumbent' => 'boolean',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_nepali' => $this->name_nepali,
            'party' => $this->party->name ?? '',
            'constituency' => $this->constituency->name ?? '',
            'district' => $this->constituency->district ?? '',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($candidate) {
            if (empty($candidate->slug)) {
                $candidate->slug = Str::slug($candidate->name) . '-' . Str::random(5);
            }
        });
    }

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    public function constituency(): BelongsTo
    {
        return $this->belongsTo(Constituency::class);
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }
}
