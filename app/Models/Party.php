<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Party extends Model
{
    use Searchable;

    protected $fillable = [
        'name', 'name_nepali', 'abbreviation', 'symbol_image', 
        'founded_year', 'ideology', 'website', 'description', 
        'color_hex', 'logo_image', 'is_active'
    ];

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function manifestos(): HasMany
    {
        return $this->hasMany(Manifesto::class);
    }
}
