<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\ElectionTimeline;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        $timeline = ElectionTimeline::orderBy('date')->get();
        return view('how-it-works', compact('faqs', 'timeline'));
    }
}
