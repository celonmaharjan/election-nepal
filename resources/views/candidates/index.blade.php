@extends('layouts.main')

@section('content')
<div class="bg-[#003893] py-16 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tighter italic">Candidate <span class="text-red-500 not-italic">Directory</span></h1>
        <p class="text-xl text-blue-100 font-medium max-w-2xl">Search and explore profiles of all {{ number_format($candidates->total()) }} candidates contesting in the 2026 General Election.</p>
    </div>
    <div class="absolute top-0 right-0 w-full h-full opacity-10 pointer-events-none translate-x-1/4">
        <svg viewBox="0 0 100 100" class="w-full h-full fill-white">
            <circle cx="50" cy="50" r="40" stroke="white" stroke-width="0.5" fill="none" />
            <circle cx="50" cy="50" r="30" stroke="white" stroke-width="0.5" fill="none" />
        </svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Modern Sidebar Filters -->
        <aside class="w-full lg:w-80 shrink-0">
            <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 sticky top-24">
                <h3 class="text-lg font-black text-gray-900 mb-8 flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Refine Search
                </h3>
                
                <form action="{{ route('candidates.index') }}" method="GET" class="space-y-8">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Name or Keyword</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. Balen Shah" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all font-bold text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Province</label>
                        <select name="province" class="w-full rounded-2xl border-gray-100 bg-gray-50 font-bold text-sm">
                            <option value="">All Regions</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ request('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Political Party</label>
                        <select name="party" class="w-full rounded-2xl border-gray-100 bg-gray-50 font-bold text-sm">
                            <option value="">All Parties</option>
                            @foreach($parties as $party)
                            <option value="{{ $party->id }}" {{ request('party') == $party->id ? 'selected' : '' }}>{{ $party->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-black transition shadow-lg shadow-gray-200">Apply Filters</button>
                    <a href="{{ route('candidates.index') }}" class="block text-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-red-600 transition">Reset All</a>
                </form>
            </div>
        </aside>

        <!-- Candidate Grid -->
        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($candidates as $candidate)
                <div class="group bg-white rounded-[48px] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col">
                    <div class="p-8 pb-0 text-center flex flex-col items-center">
                        <!-- Profile Image Circle -->
                        <div class="relative mb-6">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-xl bg-gray-50 group-hover:scale-105 transition duration-500">
                                @if($candidate->photo)
                                    <img src="{{ $candidate->photo }}" 
                                         alt="{{ $candidate->name }}" 
                                         class="w-full h-full object-cover" 
                                         referrerpolicy="no-referrer"
                                         x-data
                                         x-on:error="$el.src='https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=256&background=random&color=fff';">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=256&background=random&color=fff" class="w-full h-full">
                                @endif
                            </div>
                            <!-- Party Badge -->
                            <div class="absolute -bottom-2 right-0 w-10 h-10 rounded-2xl bg-white shadow-lg border border-gray-50 flex items-center justify-center overflow-hidden p-1.5">
                                @if($candidate->party && $candidate->party->logo_image)
                                    <img src="{{ $candidate->party->logo_image }}" class="w-full h-full object-contain">
                                @else
                                    <span class="text-[8px] font-black uppercase tracking-tighter" style="color: {{ $candidate->party->color_hex ?? '#333' }}">
                                        {{ $candidate->party->abbreviation ?? 'INDPT' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-red-600 transition tracking-tight leading-tight">{{ $candidate->name }}</h3>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2 flex items-center justify-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $candidate->constituency->name ?? '' }}
                            </div>
                        </div>

                        <div class="flex gap-2 mb-8 flex-wrap justify-center">
                            @if($candidate->is_incumbent)
                                <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border border-green-100">Incumbent</span>
                            @endif
                            <span class="bg-gray-50 text-gray-500 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border border-gray-100">{{ $candidate->age }} Years</span>
                        </div>
                    </div>

                    <a href="{{ route('candidates.show', $candidate->slug) }}" class="mt-auto block w-full py-5 bg-gray-50 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-900 hover:bg-red-600 hover:text-white transition duration-300">
                        View Public Profile &rarr;
                    </a>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-gray-50 rounded-[60px] border-2 border-dashed border-gray-200">
                    <div class="text-4xl mb-4">🔍</div>
                    <h3 class="text-xl font-black text-gray-400 italic">{{ __('messages.no_candidates_found') }}</h3>
                    <p class="text-sm text-gray-400 mt-2">{{ __('messages.adjust_filters') }}</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $candidates->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
