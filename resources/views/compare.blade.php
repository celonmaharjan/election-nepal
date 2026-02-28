@extends('layouts.main')

@section('content')
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tighter italic">Compare <span class="text-blue-600 not-italic">Candidates</span></h1>
        <p class="text-xl text-gray-500 font-medium">Select up to 3 candidates to view their educational background, assets, and records side-by-side.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="compareApp()">
    <!-- Selection Area -->
    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 mb-12">
        <form action="{{ route('compare') }}" method="GET" class="flex flex-col lg:flex-row gap-6 items-end">
            @for($i = 0; $i < 3; $i++)
            <div class="flex-1 w-full relative" x-data="{ open: false, search: '', selectedName: '{{ isset($candidates[$i]) ? $candidates[$i]->name : "Select Candidate" }}' }">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-2">Slot {{ $i + 1 }}</label>
                
                <input type="hidden" name="ids[]" :value="selectedId{{ $i }}">
                
                <button type="button" @click="open = !open" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-left font-bold text-sm flex justify-between items-center hover:bg-white hover:border-blue-200 transition-all">
                    <span x-text="selectedName" :class="selectedName === 'Select Candidate' ? 'text-gray-400' : 'text-gray-900'"></span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <!-- Searchable Dropdown List -->
                <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 w-full bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden" style="display: none;">
                    <div class="p-4 border-b border-gray-50">
                        <input type="text" x-model="search" placeholder="Type to search..." class="w-full bg-gray-50 border-none rounded-xl px-4 py-2 text-sm font-bold focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <template x-for="c in filteredCandidates(search, {{ $i }})" :key="c.id">
                            <button type="button" @click="selectCandidate(c, {{ $i }}); open = false; selectedName = c.name;" class="w-full text-left px-6 py-3 text-sm font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition flex items-center justify-between">
                                <span x-text="c.name"></span>
                                <span class="text-[10px] opacity-40" x-text="c.party"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
            @endfor
            
            <div class="flex gap-4 w-full lg:w-auto">
                <button type="submit" class="flex-1 lg:flex-none bg-[#003893] text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-800 transition shadow-xl shadow-blue-900/20">Compare</button>
                <a href="{{ route('compare') }}" class="lg:flex-none bg-gray-100 text-gray-400 p-4 rounded-2xl hover:bg-red-50 hover:text-red-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h14"/></svg>
                </a>
            </div>
        </form>
    </div>

    @if(!empty($candidates) && count($candidates) > 0)
    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded-[48px] shadow-sm border border-gray-100 overflow-hidden">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-10 py-10 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-r border-gray-50">Comparison Metric</th>
                    @foreach($candidates as $candidate)
                    <th class="px-10 py-10 text-left min-w-[300px]">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 rounded-full overflow-hidden shadow-xl border-4 border-white bg-white shrink-0">
                                <img src="{{ $candidate->photo }}" 
                                     alt="{{ $candidate->name }}" 
                                     class="w-full h-full object-cover"
                                     referrerpolicy="no-referrer"
                                     x-data
                                     x-on:error="$el.src='https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=128&background=random&color=fff';">
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] font-black uppercase tracking-widest text-blue-600 mb-1">{{ $candidate->party->abbreviation ?? 'INDPT' }}</div>
                                <div class="font-black text-gray-900 text-xl tracking-tight leading-tight truncate">{{ $candidate->name }}</div>
                            </div>
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <tr class="hover:bg-gray-50/30 transition">
                    <td class="px-10 py-8 font-black text-gray-400 text-[10px] uppercase tracking-widest border-r border-gray-50">Constituency</td>
                    @foreach($candidates as $candidate)
                    <td class="px-10 py-8 font-bold text-gray-900">{{ $candidate->constituency->name ?? 'N/A' }}</td>
                    @endforeach
                </tr>
                <tr class="hover:bg-gray-50/30 transition">
                    <td class="px-10 py-8 font-black text-gray-400 text-[10px] uppercase tracking-widest border-r border-gray-50">Age</td>
                    @foreach($candidates as $candidate)
                    <td class="px-10 py-8 font-bold text-gray-900">{{ $candidate->age }} Years</td>
                    @endforeach
                </tr>
                <tr class="hover:bg-gray-50/30 transition">
                    <td class="px-10 py-8 font-black text-gray-400 text-[10px] uppercase tracking-widest border-r border-gray-50">Education</td>
                    @foreach($candidates as $candidate)
                    <td class="px-10 py-8">
                        <div class="font-bold text-gray-900">{{ $candidate->education_level ?? 'Not Disclosed' }}</div>
                        <div class="text-[10px] text-gray-400 mt-1 line-clamp-1 italic">{{ $candidate->education_details }}</div>
                    </td>
                    @endforeach
                </tr>
                <tr class="hover:bg-gray-50/30 transition">
                    <td class="px-10 py-8 font-black text-gray-400 text-[10px] uppercase tracking-widest border-r border-gray-50">Experience</td>
                    @foreach($candidates as $candidate)
                    <td class="px-10 py-8">
                        @if($candidate->is_incumbent)
                            <span class="bg-green-50 text-green-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-green-100">Former MP / Incumbent</span>
                        @else
                            <span class="bg-gray-50 text-gray-400 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-gray-100">Challenger</span>
                        @endif
                    </td>
                    @endforeach
                </tr>
                <tr class="hover:bg-gray-50/30 transition align-top">
                    <td class="px-10 py-8 font-black text-gray-400 text-[10px] uppercase tracking-widest border-r border-gray-50 pt-10">Popularity</td>
                    @foreach($candidates as $candidate)
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                            <span class="font-black text-gray-900">{{ number_format($candidate->view_count) }}</span>
                        </div>
                        <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Public Interest Views</div>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <div class="py-32 text-center bg-gray-50 rounded-[60px] border-2 border-dashed border-gray-200">
        <div class="text-5xl mb-6">⚖️</div>
        <h3 class="text-2xl font-black text-gray-400 italic tracking-tighter">Ready to Compare</h3>
        <p class="text-sm text-gray-400 mt-2">Select candidates above to see a side-by-side analysis.</p>
    </div>
    @endif
</div>

<script>
    function compareApp() {
        return {
            allCandidates: [
                @foreach(\App\Models\Candidate::select('id', 'name', 'party_id')->with('party:id,abbreviation')->get() as $c)
                { id: {{ $c->id }}, name: '{{ addslashes($c->name) }}', party: '{{ $c->party->abbreviation ?? "INDPT" }}' },
                @endforeach
            ],
            selectedId0: '{{ request('ids.0', '') }}',
            selectedId1: '{{ request('ids.1', '') }}',
            selectedId2: '{{ request('ids.2', '') }}',
            
            filteredCandidates(search, slotIndex) {
                if (!search) return []; // Don't show all 3400 at once!
                
                const query = search.toLowerCase();
                return this.allCandidates.filter(c => {
                    // Check if already selected in OTHER slots
                    const isDuplicate = 
                        (slotIndex !== 0 && c.id == this.selectedId0) ||
                        (slotIndex !== 1 && c.id == this.selectedId1) ||
                        (slotIndex !== 2 && c.id == this.selectedId2);
                    
                    return !isDuplicate && c.name.toLowerCase().includes(query);
                }).slice(0, 50); // Cap at 50 results for speed
            },
            
            selectCandidate(c, slotIndex) {
                this['selectedId' + slotIndex] = c.id;
            }
        }
    }
</script>
@endsection
