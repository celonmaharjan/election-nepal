<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAlias extends Model
{
    protected $fillable = ['alias', 'standard_name', 'category'];

    /**
     * Resolve a messy string to its standard form using the database.
     */
    public static function resolve(string $messyString, string $category): string
    {
        $messyString = trim($messyString);
        
        if (empty($messyString)) return 'Not Disclosed';

        // Fast lookup in DB
        $standard = self::where('category', $category)
            ->where('alias', 'ilike', $messyString)
            ->first();

        return $standard ? $standard->standard_name : $messyString;
    }
}
