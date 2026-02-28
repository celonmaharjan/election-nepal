<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsArticle::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'ilike', '%' . $search . '%')
                  ->orWhere('summary', 'ilike', '%' . $search . '%')
                  ->orWhere('content', 'ilike', '%' . $search . '%')
                  ->orWhere('source', 'ilike', '%' . $search . '%');
            });
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        return view('news.index', compact('articles'));
    }
}
