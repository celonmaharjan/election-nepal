<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        SEOTools::setTitle('Search Results for: ' . $query);
        
        if (empty($query)) {
            return redirect()->route('home');
        }

        $candidates = Candidate::with('party', 'constituency')
            ->where('name', 'ilike', '%' . $query . '%')
            ->orWhere('name_nepali', 'ilike', '%' . $query . '%')
            ->take(10)
            ->get();

        $constituencies = Constituency::with('province')
            ->where('name', 'ilike', '%' . $query . '%')
            ->orWhere('district', 'ilike', '%' . $query . '%')
            ->take(10)
            ->get();

        $parties = Party::where('name', 'ilike', '%' . $query . '%')
            ->orWhere('abbreviation', 'ilike', '%' . $query . '%')
            ->take(10)
            ->get();

        return view('search', compact('candidates', 'constituencies', 'parties', 'query'));
    }
}
