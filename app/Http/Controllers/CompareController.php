<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle('Compare Candidates - Nepal Election 2026');
        SEOTools::setDescription('Compare candidates side-by-side on education, assets, criminal cases, and manifesto promises.');

        $ids = $request->input('ids', []);
        $candidates = [];

        if (!empty($ids)) {
            $candidates = Candidate::with('party', 'constituency')->whereIn('id', $ids)->get();
        }

        $allCandidates = Candidate::select('id', 'name')->get();

        return view('compare', compact('candidates', 'allCandidates'));
    }
}
