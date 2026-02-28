@extends('layouts.main')

@section('content')
<!-- Premium Header -->
<div class="bg-gray-900 pt-20 pb-32 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-1 bg-red-600 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6 animate-pulse">
            Official Registry 2026
        </div>
        <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tighter italic">Political <span class="text-blue-500 not-italic">Landscape</span></h1>
        <p class="text-xl text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">
            Exploring the coalitions, ideologies, and candidates of the {{ $majorParties->count() + $otherParties->count() }} parties shaping Nepal's democratic future.
        </p>
    </div>
    <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none">
        <div class="absolute top-10 left-10 w-64 h-64 bg-blue-600 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-red-600 rounded-full blur-[120px]"></div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
    <!-- Section 1: Major Parties (Bento Grid) -->
    <div class="mb-24">
        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-gray-400 mb-8 flex items-center gap-4">
            <span class="w-12 h-px bg-gray-200"></span>
            Major Parliamentary Forces
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($majorParties as $party)
            <a href="{{ route('parties.show', $party->id) }}" class="group bg-white rounded-[48px] p-2 shadow-sm hover:shadow-2xl transition-all duration-700 border border-gray-100 hover:-translate-y-2">
                <div class="bg-gray-50 rounded-[40px] p-10 h-full flex flex-col items-center text-center border border-transparent group-hover:border-blue-100 transition duration-700">
                    <div class="w-24 h-24 rounded-3xl overflow-hidden shadow-xl bg-white mb-8 group-hover:scale-110 transition duration-700 p-3 flex items-center justify-center">
                        @if($party->logo_image)
                            <img src="{{ $party->logo_image }}" 
                                 alt="{{ $party->abbreviation }}" 
                                 class="w-full h-full object-contain" 
                                 referrerpolicy="no-referrer" 
                                 x-data 
                                 x-on:error="$el.style.display='none'; $el.nextElementSibling.style.display='flex'">
                            <div class="hidden w-full h-full items-center justify-center font-black text-white text-3xl rounded-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                                {{ substr($party->abbreviation, 0, 1) }}
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-white text-3xl rounded-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                                {{ substr($party->abbreviation, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-6">
                        <div class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-2">{{ $party->abbreviation }}</div>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight leading-tight px-4 line-clamp-2">{{ $party->name }}</h3>
                    </div>

                    <div class="flex gap-2 mb-8">
                        <span class="bg-white px-4 py-1.5 rounded-full text-[10px] font-black text-gray-500 shadow-sm border border-gray-100 uppercase tracking-tighter">
                            {{ number_format($party->candidates_count) }} Candidates
                        </span>
                    </div>

                    <div class="mt-auto pt-6 w-full border-t border-gray-200/50 flex justify-center items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 group-hover:text-red-600 transition">
                        Explore Portfolio
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Section 2: Other Registered Parties (Redesigned Directory) -->
    <div class="mb-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-gray-400 mb-2 flex items-center gap-4">
                    <span class="w-12 h-px bg-gray-200"></span>
                    Registry
                </h2>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">Political Entities</p>
            </div>
            <div class="relative w-full md:w-80">
                <input type="text" placeholder="Search directory..." class="w-full pl-12 pr-6 py-4 bg-white rounded-2xl border-gray-100 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent font-bold text-sm">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($otherParties as $party)
            <a href="{{ route('parties.show', $party->id) }}" class="group bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500 flex items-start gap-6">
                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-50 flex items-center justify-center shrink-0 border border-gray-50 group-hover:scale-110 transition duration-500 shadow-sm">
                    @if($party->logo_image)
                        <img src="{{ $party->logo_image }}" 
                             alt="{{ $party->abbreviation }}" 
                             class="w-full h-full object-contain p-2" 
                             referrerpolicy="no-referrer"
                             x-data
                             x-on:error="$el.style.display='none'; $el.nextElementSibling.style.display='flex'">
                        <div class="hidden w-full h-full items-center justify-center font-black text-xs text-white uppercase rounded-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                            {{ substr($party->abbreviation, 0, 3) }}
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center font-black text-xs text-white uppercase rounded-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                            {{ substr($party->abbreviation, 0, 3) }}
                        </div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1">{{ $party->abbreviation }}</div>
                    <div class="font-black text-gray-900 text-lg leading-tight group-hover:text-red-600 transition mb-2">{{ $party->name }}</div>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ number_format($party->candidates_count) }} Candidates</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
