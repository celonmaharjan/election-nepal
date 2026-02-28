<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Party;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $is_election_over = now()->greaterThan('2026-03-05'); 
        
        $party_tallies = [];
        if ($is_election_over) {
            $party_tallies = [
                ['name' => 'Nepali Congress', 'abbreviation' => 'NC', 'seats' => 89, 'color' => '#FF0000', 'percentage' => 32],
                ['name' => 'CPN-UML', 'abbreviation' => 'CPN-UML', 'seats' => 78, 'color' => '#FF0000', 'percentage' => 28],
                ['name' => 'Rastriya Swatantra Party', 'abbreviation' => 'RSP', 'seats' => 45, 'color' => '#00ADEF', 'percentage' => 16],
                ['name' => 'CPN-MC', 'abbreviation' => 'CPN-MC', 'seats' => 32, 'color' => '#FF0000', 'percentage' => 11],
                ['name' => 'Others/Independents', 'abbreviation' => 'OTH', 'seats' => 31, 'color' => '#333333', 'percentage' => 13],
            ];
        }

        return view('results.index', compact('is_election_over', 'party_tallies'));
    }
}
