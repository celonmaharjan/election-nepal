<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Political Parties - Nepal Election 2026');
        SEOTools::setDescription('List of all registered political parties in Nepal for the 2026 House of Representatives election.');

        $majorAbbreviations = ['NC', 'CPN-UML', 'CPN-MC', 'RSP', 'RPP', 'JSP-N'];
        
        $allParties = Party::withCount('candidates')
            ->orderByDesc('candidates_count')
            ->get();

        $majorParties = $allParties->filter(fn($p) => in_array($p->abbreviation, $majorAbbreviations));
        $otherParties = $allParties->reject(fn($p) => in_array($p->abbreviation, $majorAbbreviations));

        return view('parties.index', compact('majorParties', 'otherParties'));
    }

    public function show($id)
    {
        $party = Party::with(['candidates.constituency', 'manifestos'])->findOrFail($id);

        SEOTools::setTitle($party->name . ' (' . $party->abbreviation . ') - Party Profile');
        SEOTools::setDescription("Everything you need to know about {$party->name} ({$party->abbreviation}) including manifesto, candidates, and ideology.");

        return view('parties.show', compact('party'));
    }
}
