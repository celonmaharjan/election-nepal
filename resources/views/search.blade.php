@extends('layouts.main')

@section('content')
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-2 tracking-tighter">Search Results</h1>
        <p class="text-xl text-gray-500 font-medium">Results for: <span class="text-[#003893] italic">"{{ $query }}"</span></p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-16">
        <!-- Candidates Section -->
        @if($candidates->count() > 0)
        <section>
            <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                <span class="w-2 h-6 rounded-full bg-[#DC143C]"></span>
                Candidates ({{ $candidates->count() }})
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($candidates as $candidate)
                <a href="{{ route('candidates.show', $candidate->slug) }}" class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center font-black text-gray-300 group-hover:text-blue-500 transition">
                            {{ substr($candidate->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-black text-gray-900 group-hover:text-blue-800 transition">{{ $candidate->name }}</div>
                            <div class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $candidate->party->abbreviation ?? 'Independent' }} - {{ $candidate->constituency->name ?? '' }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Constituencies Section -->
        @if($constituencies->count() > 0)
        <section>
            <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                <span class="w-2 h-6 rounded-full bg-[#003893]"></span>
                Constituencies ({{ $constituencies->count() }})
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($constituencies as $constituency)
                <a href="{{ route('constituencies.show', $constituency->id) }}" class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                    <div class="font-black text-gray-900 group-hover:text-blue-800 transition text-lg mb-1">{{ $constituency->name }}</div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $constituency->district }} - {{ $constituency->province->name ?? '' }}</div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Parties Section -->
        @if($parties->count() > 0)
        <section>
            <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-4">
                <span class="w-2 h-6 rounded-full bg-yellow-400"></span>
                Parties ({{ $parties->count() }})
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($parties as $party)
                <a href="{{ route('parties.show', $party->id) }}" class="p-6 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center font-black text-white" style="background-color: {{ $party->color_hex ?? '#333' }}">
                        {{ substr($party->abbreviation, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-black text-gray-900 group-hover:text-blue-800 transition">{{ $party->name }}</div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $party->abbreviation }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        @if($candidates->count() == 0 && $constituencies->count() == 0 && $parties->count() == 0)
        <div class="py-20 text-center bg-gray-50 rounded-[60px] border-2 border-dashed border-gray-200">
            <h3 class="text-2xl font-black text-gray-400 mb-4 italic">No results found for "{{ $query }}"</h3>
            <p class="text-gray-500 font-medium">Try searching for a different name, district, or party.</p>
            <a href="{{ route('home') }}" class="inline-block mt-8 text-[#003893] font-black uppercase tracking-widest text-sm hover:underline">Back to Home &rarr;</a>
        </div>
        @endif
    </div>
</div>
@endsection
