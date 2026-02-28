@extends('layouts.main')

@section('content')
@if(!$is_election_over)
<div class="bg-gray-900 py-32 text-center text-white overflow-hidden relative">
    <div class="max-w-4xl mx-auto px-4 relative z-10">
        <div class="inline-block px-4 py-1 bg-white/10 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-widest mb-10 border border-white/5">
            Election Countdown
        </div>
        <h1 class="text-5xl md:text-7xl font-black mb-10 tracking-tighter">Live Results <br><span class="text-blue-500 italic">Coming Soon</span></h1>
        <p class="text-xl text-gray-400 font-medium mb-16 leading-relaxed">The General Election results for the House of Representatives will be published live starting from the evening of March 5, 2026.</p>
        
        <div class="flex flex-wrap justify-center gap-6">
            <div class="bg-white/5 backdrop-blur-md p-10 rounded-[40px] border border-white/5 min-w-[200px]">
                <div class="text-4xl font-black mb-2">Mar 5</div>
                <div class="text-[10px] font-black uppercase tracking-widest text-blue-500">Election Day</div>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-10 rounded-[40px] border border-white/5 min-w-[200px]">
                <div class="text-4xl font-black mb-2">08:00</div>
                <div class="text-[10px] font-black uppercase tracking-widest text-blue-500">Voting Begins</div>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-10 rounded-[40px] border border-white/5 min-w-[200px]">
                <div class="text-4xl font-black mb-2">17:00</div>
                <div class="text-[10px] font-black uppercase tracking-widest text-blue-500">Voting Ends</div>
            </div>
        </div>
    </div>
</div>
@else
<div class="bg-[#003893] py-20 text-white overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tighter">Election Results 2026</h1>
        <p class="text-xl text-blue-100 font-medium">Live national seat tally and winning candidates from all 165 FPTP seats.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
        <!-- Main Dashboard -->
        <div class="lg:col-span-2 space-y-16">
            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-10 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-[#DC143C]"></span>
                    National Seat Tally
                </h2>
                <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm">
                    <div class="space-y-10">
                        @foreach($party_tallies as $party)
                        <div class="relative">
                            <div class="flex justify-between items-center mb-4">
                                <div class="font-black text-gray-900 flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $party['color'] }}"></span>
                                    {{ $party['name'] }}
                                </div>
                                <div class="font-black text-2xl text-gray-900">{{ $party['seats'] }} <span class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Seats</span></div>
                            </div>
                            <div class="w-full bg-gray-50 h-4 rounded-full overflow-hidden">
                                <div 
                                    class="h-full rounded-full transition-all duration-1000 ease-out shadow-sm shadow-inner" 
                                    style="width: {{ $party['percentage'] }}%; background-color: {{ $party['color'] }}"
                                ></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-16 pt-10 border-t border-gray-100 flex justify-between items-center text-xs font-black uppercase tracking-widest text-gray-400">
                        <span>Total 275 Seats (FPTP + PR)</span>
                        <span>Update: {{ now()->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-10 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-blue-500"></span>
                    Interactive Map TBD
                </h2>
                <div class="bg-gray-100 aspect-video rounded-[60px] flex items-center justify-center border border-gray-200">
                    <p class="text-gray-400 font-bold italic">SVG Nepal Map visualization will load here.</p>
                </div>
            </section>
        </div>

        <!-- Winning Stats -->
        <aside class="space-y-12">
            <div class="bg-gray-900 text-white p-10 rounded-[40px] shadow-2xl">
                <h3 class="text-xl font-black mb-8">Summary Stats</h3>
                <div class="space-y-8">
                    <div class="p-6 bg-white/5 rounded-2xl border border-white/5">
                        <div class="text-[10px] font-black uppercase tracking-widest text-blue-500 mb-2">Total Votes Counted</div>
                        <div class="text-3xl font-black">15,482,901</div>
                    </div>
                    <div class="p-6 bg-white/5 rounded-2xl border border-white/5">
                        <div class="text-[10px] font-black uppercase tracking-widest text-[#DC143C] mb-2">Seats Declared</div>
                        <div class="text-3xl font-black">275 / 275</div>
                    </div>
                    <div class="p-6 bg-white/5 rounded-2xl border border-white/5">
                        <div class="text-[10px] font-black uppercase tracking-widest text-green-500 mb-2">Voter Turnout</div>
                        <div class="text-3xl font-black">81.4%</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 p-10 rounded-[40px] border border-blue-100">
                <h3 class="text-xl font-black text-[#003893] mb-4">Notable Upsets</h3>
                <p class="text-sm text-blue-800/60 mb-8 font-medium italic">Key high-profile seats that changed hands this election.</p>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-2xl border border-blue-100 shadow-sm font-bold text-gray-900 text-sm">Kathmandu 5 - Balen Shah Wins!</div>
                    <div class="bg-white p-4 rounded-2xl border border-blue-100 shadow-sm font-bold text-gray-900 text-sm">Jhapa 5 - CPN-UML retains seat</div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endif
@endsection
