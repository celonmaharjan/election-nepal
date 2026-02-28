<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\ElectionTimeline;
use App\Models\NewsArticle;
use App\Models\Party;
use App\Models\Province;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Nepal General Election 2026 - Live Updates & Candidates');
        SEOTools::setDescription('Comprehensive guide to Nepal\'s House of Representatives election on March 5, 2026. Find candidates, parties, constituencies, and live results.');
        SEOTools::opengraph()->setUrl(route('home'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@NepalElection2026');

        $voter_count = '18.9M'; // Static for now
        $seats_count = 275;
        $candidate_count = Candidate::count();
        $provinces_count = Province::count();

        $featured_constituencies = Constituency::with('candidates.party')
            ->take(3)
            ->get();

        $latest_news = NewsArticle::latest()->take(5)->get();
        $timeline = ElectionTimeline::all();
        $parties = Party::take(6)->get();

        return view('home', compact(
            'voter_count',
            'seats_count',
            'candidate_count',
            'provinces_count',
            'featured_constituencies',
            'latest_news',
            'timeline',
            'parties'
        ));
    }
}
