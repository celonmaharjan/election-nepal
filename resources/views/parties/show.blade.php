@extends('layouts.main')

@section('content')
<div class="bg-gray-900 py-20 text-white overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="w-48 h-48 rounded-[40px] overflow-hidden shadow-2xl bg-white p-6 shrink-0 flex items-center justify-center border-8 border-gray-800">
                @if($party->logo_image)
                    <img src="{{ $party->logo_image }}" 
                         alt="{{ $party->name }}" 
                         class="w-full h-full object-contain" 
                         referrerpolicy="no-referrer"
                         x-data
                         x-on:error="$el.style.display='none'; $el.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-full items-center justify-center font-black text-gray-900 text-6xl">
                        {{ substr($party->abbreviation, 0, 1) }}
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center font-black text-gray-900 text-6xl">
                        {{ substr($party->abbreviation, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="text-center md:text-left">
                <div class="inline-block px-4 py-1 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest mb-6 border border-white/10">
                    Political Party Profile
                </div>
                <h1 class="text-4xl md:text-7xl font-black mb-4 leading-tight tracking-tighter">{{ $party->name }}</h1>
                <p class="text-2xl text-gray-400 font-medium mb-10">{{ $party->name_nepali }}</p>
                
                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    <span class="bg-white/5 border border-white/10 px-6 py-2 rounded-2xl font-black uppercase tracking-widest text-xs">
                        {{ $party->abbreviation }}
                    </span>
                    <span class="bg-white/5 border border-white/10 px-6 py-2 rounded-2xl font-black uppercase tracking-widest text-xs text-blue-400">
                        Ideology: {{ $party->ideology ?? 'Coalition' }}
                    </span>
                    @if($party->website)
                    <a href="{{ $party->website }}" target="_blank" class="bg-red-600 hover:bg-red-700 px-8 py-2 rounded-2xl font-black uppercase tracking-widest text-xs transition shadow-lg shadow-red-900/20">Official Website &rarr;</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-full h-full opacity-5 pointer-events-none translate-x-1/3">
        <div class="w-[800px] h-[800px] rounded-full border-[100px] border-white"></div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-20">
        <!-- Party Details -->
        <div class="lg:col-span-2 space-y-24">
            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-10 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-red-600"></span>
                    Vision & Mission
                </h2>
                <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm leading-relaxed text-gray-600 text-lg">
                    {{ $party->description ?? 'Detailed party vision, historical context, and election objectives will be updated as manifestos are released.' }}
                </div>
            </section>

            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-10 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-blue-600"></span>
                    Contesting Candidates ({{ $party->candidates->count() }})
                </h2>
                <div class="grid sm:grid-cols-2 gap-6">
                    @foreach($party->candidates->sortByDesc('is_incumbent')->take(20) as $candidate)
                    <a href="{{ route('candidates.show', $candidate->slug) }}" class="p-6 bg-white rounded-[32px] border border-gray-50 shadow-sm hover:shadow-xl hover:border-blue-100 transition flex items-center gap-6 group">
                        <div class="w-16 h-16 rounded-full overflow-hidden shrink-0 shadow-md border-2 border-white bg-gray-50 group-hover:scale-110 transition duration-500">
                            @if($candidate->photo)
                                <img src="{{ $candidate->photo }}" 
                                     alt="{{ $candidate->name }}" 
                                     class="w-full h-full object-cover"
                                     referrerpolicy="no-referrer"
                                     x-data
                                     x-on:error="$el.src='https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=128&background=random&color=fff';">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=128&background=random&color=fff" class="w-full h-full">
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="font-black text-gray-900 text-lg group-hover:text-red-600 transition tracking-tight truncate">{{ $candidate->name }}</div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1 truncate">{{ $candidate->constituency->name ?? 'National' }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @if($party->candidates->count() > 20)
                <div class="mt-12 text-center">
                    <a href="{{ route('candidates.index', ['party' => $party->id]) }}" class="inline-block px-10 py-4 bg-gray-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-black transition shadow-xl shadow-gray-200">View All {{ $party->candidates->count() }} Candidates</a>
                </div>
                @endif
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-12">
            <div class="bg-gray-50 p-10 rounded-[40px] border border-gray-100 shadow-sm">
                <h3 class="text-xl font-black text-gray-900 mb-10 tracking-tight">Party Statistics</h3>
                <div class="space-y-8">
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Registration Status</div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="font-black text-gray-900 uppercase text-sm">Active & Verified</span>
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Candidates Contesting</div>
                        <div class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($party->candidates->count()) }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Election Color</div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl shadow-sm border-2 border-white" style="background-color: {{ $party->color_hex ?? '#333' }}"></div>
                            <span class="font-bold text-gray-700 text-sm uppercase tracking-widest">{{ $party->color_hex ?? 'Default' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#DC143C]/5 p-10 rounded-[40px] border border-[#DC143C]/10">
                <h3 class="text-xl font-black text-[#DC143C] mb-4 tracking-tight">Official Manifesto</h3>
                <p class="text-sm text-[#DC143C]/60 mb-10 font-medium leading-relaxed">Download the full party manifesto for the 2026 General Election.</p>
                <button class="w-full bg-[#DC143C] text-white py-5 rounded-[20px] font-black uppercase tracking-widest text-xs shadow-xl shadow-red-200 hover:scale-105 transition duration-300">Download PDF &darr;</button>
            </div>
        </aside>
    </div>
</div>
@endsection
