<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Party;
use App\Models\Province;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle('Candidates - Nepal General Election 2026');
        SEOTools::setDescription('Browse all candidates contesting in the Nepal 2026 General Election. Filter by party, province, and constituency.');

        $query = Candidate::with(['party', 'constituency.province']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                  ->orWhere('name_nepali', 'ilike', '%' . $search . '%');
            });
        }

        if ($request->filled('party')) {
            $query->where('party_id', $request->party);
        }

        if ($request->filled('province')) {
            $query->whereHas('constituency', function($q) use ($request) {
                $q->where('province_id', $request->province);
            });
        }

        $candidates = $query->orderByDesc('is_incumbent')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();
        $parties = Party::all();
        $provinces = Province::all();

        return view('candidates.index', compact('candidates', 'parties', 'provinces'));
    }

    public function show($slug)
    {
        $candidate = Candidate::with(['party', 'constituency.province', 'result'])->where('slug', $slug)->firstOrFail();
        
        $partyName = $candidate->party ? $candidate->party->name : 'Independent';
        
        SEOTools::setTitle($candidate->name . ' - Candidate Profile');
        SEOTools::setDescription("Profile of $candidate->name, contesting from {$candidate->constituency->name} as {$partyName} in Nepal Election 2026.");
        SEOTools::opengraph()->setUrl(route('candidates.show', $candidate->slug));
        SEOTools::opengraph()->addProperty('type', 'profile');
        SEOTools::opengraph()->setProfile([
            'first_name' => $candidate->name,
            'username' => $candidate->slug,
            'gender' => strtolower($candidate->gender ?? 'unknown'),
        ]);

        $related_candidates = Candidate::where('constituency_id', $candidate->constituency_id)
            ->where('id', '!=', $candidate->id)
            ->with('party')
            ->get();

        return view('candidates.show', compact('candidate', 'related_candidates'));
    }
}
