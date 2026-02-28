<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\Province;
use Illuminate\Http\Request;

class ConstituencyController extends Controller
{
    public function index(Request $request)
    {
        $query = Constituency::with(['province', 'candidates.party']);

        if ($request->has('province')) {
            $query->where('province_id', $request->province);
        }

        if ($request->has('district')) {
            $query->where('district', 'ilike', '%' . $request->district . '%');
        }

        $constituencies = $query->get();
        $provinces = Province::all();

        return view('constituencies.index', compact('constituencies', 'provinces'));
    }

    public function show($id)
    {
        $constituency = Constituency::with(['province', 'candidates.party', 'results.candidate'])->findOrFail($id);
        return view('constituencies.show', compact('constituency'));
    }
}
