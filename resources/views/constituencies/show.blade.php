@extends('layouts.main')

@section('content')
<div class="bg-[#003893] py-20 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="md:w-2/3">
            <div class="inline-block px-4 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-widest mb-6 border border-white/10">
                Battleground {{ $constituency->district }}
            </div>
            <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tighter">{{ $constituency->name }}</h1>
            <p class="text-xl text-blue-100 font-medium mb-12">Located in {{ $constituency->province->name }}. This constituency represents a critical seat in the 2026 General Election with {{ number_format($constituency->total_voters ?? 0) }} registered voters.</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-blue-300 mb-1 opacity-60">Seat Type</div>
                    <div class="text-xl font-black">{{ $constituency->type }}</div>
                </div>
                <div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-blue-300 mb-1 opacity-60">Candidates</div>
                    <div class="text-xl font-black">{{ $constituency->candidates->count() }}</div>
                </div>
                <div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-blue-300 mb-1 opacity-60">Election Date</div>
                    <div class="text-xl font-black">March 5, 2026</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Simple SVG Map Decoration -->
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-1/3 opacity-10 pointer-events-none hidden lg:block">
        <svg viewBox="0 0 100 100" class="w-full h-full fill-white">
            <path d="M10,50 Q25,10 50,50 T90,50" stroke="white" stroke-width="2" fill="none" />
            <circle cx="50" cy="50" r="30" stroke="white" stroke-width="1" fill="none" />
        </svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-20">
        <!-- Candidate List -->
        <div class="lg:col-span-2 space-y-12">
            <h2 class="text-3xl font-black text-gray-900 flex items-center gap-4">
                <span class="w-2 h-8 rounded-full bg-[#DC143C]"></span>
                Candidates Contesting
            </h2>
            
            <div class="space-y-6">
                @foreach($constituency->candidates as $candidate)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-xl hover:border-blue-100 transition group p-2">
                    <div class="flex flex-col md:flex-row items-center gap-8 p-6">
                        <div class="w-24 h-24 rounded-full bg-gray-100 shrink-0 overflow-hidden ring-4 ring-gray-50 flex items-center justify-center font-black text-gray-300 text-3xl">
                            @if($candidate->photo)
                                <img src="{{ $candidate->photo }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($candidate->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 mb-2 justify-center md:justify-start">
                                <h3 class="text-2xl font-black text-gray-900 group-hover:text-blue-800 transition tracking-tight">{{ $candidate->name }}</h3>
                                <span class="px-3 py-1 bg-gray-900 text-white rounded-full text-[10px] font-black uppercase tracking-widest w-fit mx-auto md:mx-0" style="background-color: {{ $candidate->party->color_hex ?? '#000' }}">
                                    {{ $candidate->party->abbreviation ?? 'INDPT' }}
                                </span>
                            </div>
                            <p class="text-gray-500 font-medium mb-6">{{ $candidate->party->name ?? 'Independent' }}</p>
                            
                            <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                                <div class="bg-gray-50 px-4 py-2 rounded-xl text-xs font-bold text-gray-500 border border-gray-100">
                                    Age: <span class="text-gray-900">{{ $candidate->age }}</span>
                                </div>
                                <div class="bg-gray-50 px-4 py-2 rounded-xl text-xs font-bold text-gray-500 border border-gray-100">
                                    Edu: <span class="text-gray-900">{{ $candidate->education_level }}</span>
                                </div>
                                @if($candidate->is_incumbent)
                                <div class="bg-green-50 px-4 py-2 rounded-xl text-xs font-black text-green-600 border border-green-100 uppercase tracking-widest">
                                    Incumbent
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="shrink-0 w-full md:w-auto">
                            <a href="{{ route('candidates.show', $candidate->slug) }}" class="block w-full text-center px-8 py-4 bg-gray-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-600 shadow-lg shadow-gray-200 hover:shadow-blue-200 transition">View Profile</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar / History -->
        <aside class="space-y-12">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    2022 Results
                </h3>
                <div class="space-y-6">
                    <p class="text-sm text-gray-400 font-medium">Historical data for reference. The 2022 winner for this seat was:</p>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <div class="font-black text-gray-900 text-lg mb-1 italic">Winner data placeholder</div>
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">Victory Margin: TBD</div>
                    </div>
                </div>
            </div>

            <div class="bg-[#DC143C]/5 p-8 rounded-3xl border border-[#DC143C]/10">
                <h3 class="text-xl font-black text-[#DC143C] mb-4">Election Day Alert</h3>
                <p class="text-sm text-[#DC143C]/60 mb-8 font-medium leading-relaxed">Voting starts at 8:00 AM on March 5, 2026. Make sure to carry your valid voter ID card.</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#DC143C] flex items-center justify-center text-white shrink-0 shadow-lg shadow-red-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-[#DC143C]/40">Countdown</div>
                        <div class="font-black text-gray-900">March 5, 2026</div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
