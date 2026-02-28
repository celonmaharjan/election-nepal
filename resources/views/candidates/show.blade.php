@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Profile Column -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                <div class="h-64 bg-gray-200">
                    @if($candidate->photo)
                        <img src="{{ $candidate->photo }}" 
                             alt="{{ $candidate->name }}" 
                             class="w-full h-full object-cover" 
                             referrerpolicy="no-referrer"
                             onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=256&background=random';">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center font-bold text-white shadow-md text-xl" style="background-color: {{ $candidate->party->color_hex ?? '#333' }}">
                            {{ substr($candidate->party->abbreviation ?? 'I', 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 leading-tight">{{ $candidate->party->name ?? 'Independent' }}</div>
                            <div class="text-sm text-gray-500 font-bold uppercase">{{ $candidate->party->abbreviation ?? 'INDPT' }}</div>
                        </div>
                    </div>
                    
                    <h1 class="text-2xl font-black text-gray-900 mb-2">{{ $candidate->name }}</h1>
                    <div class="text-xl text-gray-400 font-medium mb-6">{{ $candidate->name_nepali }}</div>

                    <div class="space-y-4 border-t pt-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500 font-bold">Constituency</span>
                            <span class="font-bold text-blue-800">{{ $candidate->constituency->name ?? '' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500 font-bold">Age</span>
                            <span class="font-bold">{{ $candidate->age }} Years</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500 font-bold">Education</span>
                            <span class="font-bold">{{ $candidate->education_level }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500 font-bold">Incumbent</span>
                            <span class="font-bold {{ $candidate->is_incumbent ? 'text-green-600' : 'text-gray-400' }}">
                                {{ $candidate->is_incumbent ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-[#DC143C] text-white py-3 rounded-xl font-bold mt-8 shadow-lg shadow-red-100 hover:shadow-xl transition">Share Profile</button>
                </div>
            </div>
        </div>

        <!-- Details Column -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Manifesto Summary -->
            <section>
                <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                    <span class="bg-blue-100 text-[#003893] p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    Manifesto Summary
                </h2>
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm leading-relaxed text-gray-700">
                    {{ $candidate->manifesto_summary ?? 'No personal manifesto summary provided yet.' }}
                </div>
            </section>

            <!-- Assets Declaration -->
            <section>
                <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                    <span class="bg-yellow-100 text-yellow-700 p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    Asset Declaration
                </h2>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-sm font-black text-gray-500">Asset Type</th>
                                <th class="px-6 py-4 text-sm font-black text-gray-500">Declared Value</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @php $assets = $candidate->assets_declared ?? ['Property' => 'TBD', 'Cash' => 'TBD', 'Vehicles' => 'TBD']; @endphp
                            @foreach($assets as $key => $value)
                            <tr>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $key) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Criminal Cases -->
            <section>
                <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                    <span class="bg-red-100 text-[#DC143C] p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </span>
                    Criminal Cases
                </h2>
                <div class="p-8 rounded-2xl border {{ $candidate->criminal_cases > 0 ? 'bg-red-50 border-red-100' : 'bg-green-50 border-green-100' }} flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-black {{ $candidate->criminal_cases > 0 ? 'text-[#DC143C]' : 'text-green-700' }}">
                            {{ $candidate->criminal_cases }}
                        </div>
                        <div class="text-sm font-bold uppercase opacity-60">Pending cases declared</div>
                    </div>
                    @if($candidate->criminal_cases == 0)
                        <span class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-xs font-black uppercase">Clean Record</span>
                    @else
                        <span class="bg-red-100 text-red-800 px-4 py-1 rounded-full text-xs font-black uppercase">Disclosure Required</span>
                    @endif
                </div>
            </section>

            <!-- Related Candidates -->
            <section>
                <h2 class="text-xl font-black text-gray-900 mb-6">Opponents in {{ $candidate->constituency->name }}</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($related_candidates as $opponent)
                    <a href="{{ route('candidates.show', $opponent->slug) }}" class="flex items-center gap-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:border-blue-200 transition group">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center font-bold text-gray-400 group-hover:text-blue-500 transition">
                            {{ substr($opponent->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 group-hover:text-blue-800 transition">{{ $opponent->name }}</div>
                            <div class="text-xs text-gray-400 font-bold uppercase">{{ $opponent->party->abbreviation ?? 'INDPT' }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
