<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = ['name', 'number'];

    public function constituencies(): HasMany
    {
        return $this->hasMany(Constituency::class);
    }
}
