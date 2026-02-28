@extends('layouts.main')

@section('content')
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tighter">Nepal Constituencies</h1>
        <p class="text-xl text-gray-500 font-medium">Explore all 165 direct-vote (FPTP) seats across the 7 provinces of Nepal.</p>
        
        <div class="mt-12 flex flex-wrap gap-4">
            <a href="{{ route('constituencies.index') }}" class="px-6 py-2 bg-white rounded-full font-bold shadow-sm border border-gray-200 {{ !request('province') ? 'bg-blue-600 text-white border-blue-600' : '' }}">All</a>
            @foreach($provinces as $province)
            <a href="{{ route('constituencies.index', ['province' => $province->id]) }}" class="px-6 py-2 bg-white rounded-full font-bold shadow-sm border border-gray-200 hover:border-blue-500 transition {{ request('province') == $province->id ? 'bg-blue-600 text-white border-blue-600' : '' }}">{{ $province->name }}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @foreach($constituencies as $constituency)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-blue-100 transition group">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">{{ $constituency->district }}</div>
                        <h2 class="text-2xl font-black text-gray-900 group-hover:text-blue-800 transition tracking-tight">{{ $constituency->name }}</h2>
                    </div>
                    <div class="bg-gray-50 px-3 py-1 rounded-lg font-black text-xs text-gray-400">#{{ $constituency->number }}</div>
                </div>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Total Voters</span>
                        <span class="font-black text-gray-900">{{ number_format($constituency->total_voters ?? 0) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Candidates</span>
                        <span class="font-black text-gray-900">{{ $constituency->candidates->count() }}</span>
                    </div>
                </div>

                <div class="flex -space-x-3 mb-10 overflow-hidden">
                    @foreach($constituency->candidates->take(5) as $candidate)
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center font-bold text-gray-400 text-xs shadow-sm ring-1 ring-gray-100">
                        {{ substr($candidate->name, 0, 1) }}
                    </div>
                    @endforeach
                    @if($constituency->candidates->count() > 5)
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-50 flex items-center justify-center font-bold text-[#003893] text-xs shadow-sm ring-1 ring-blue-100">
                        +{{ $constituency->candidates->count() - 5 }}
                    </div>
                    @endif
                </div>

                <a href="{{ route('constituencies.show', $constituency->id) }}" class="block w-full text-center py-4 bg-gray-50 text-gray-900 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-[#003893] hover:text-white transition group">Explore Battleground</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
