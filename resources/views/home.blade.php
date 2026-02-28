@extends('layouts.main')

@section('content')
<div class="relative bg-[#003893] text-white py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="md:w-2/3">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">{{ __('messages.nepal_election_2026') }}</h1>
            <p class="text-xl mb-8 text-blue-100">Decision for the future of Nepal. Join the historic House of Representatives election on March 5, 2026.</p>
            
            <div class="flex flex-wrap gap-4 mb-10" x-data="countdown('2026-03-05T08:00:00')">
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-lg text-center min-w-[80px]">
                    <div class="text-3xl font-bold" x-text="days">00</div>
                    <div class="text-xs uppercase">Days</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-lg text-center min-w-[80px]">
                    <div class="text-3xl font-bold" x-text="hours">00</div>
                    <div class="text-xs uppercase">Hours</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-lg text-center min-w-[80px]">
                    <div class="text-3xl font-bold" x-text="minutes">00</div>
                    <div class="text-xs uppercase">Minutes</div>
                </div>
            </div>

            <form action="{{ route('search') }}" method="GET" class="bg-white rounded-full p-1 flex max-w-lg shadow-xl">
                <input type="text" name="search" placeholder="{{ __('messages.search_placeholder') }}" class="flex-1 border-none bg-transparent px-6 text-gray-900 focus:ring-0">
                <button type="submit" class="bg-[#DC143C] text-white px-8 py-3 rounded-full font-bold hover:bg-[#b01030] transition">{{ __('messages.search') }}</button>
            </form>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-1/3 h-full opacity-20 hidden md:block">
        <svg viewBox="0 0 100 100" class="h-full w-full">
            <polygon points="0,0 100,0 100,100 0,100" fill="currentColor" />
        </svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-[#DC143C]">
            <div class="text-gray-500 text-sm font-semibold uppercase">{{ __('messages.total_voters') }}</div>
            <div class="text-3xl font-bold">{{ $voter_count }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-[#003893]">
            <div class="text-gray-500 text-sm font-semibold uppercase">{{ __('messages.total_seats') }}</div>
            <div class="text-3xl font-bold">{{ $seats_count }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-yellow-400">
            <div class="text-gray-500 text-sm font-semibold uppercase">{{ __('messages.candidates') }}</div>
            <div class="text-3xl font-bold">{{ $candidate_count }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-green-500">
            <div class="text-gray-500 text-sm font-semibold uppercase">Provinces</div>
            <div class="text-3xl font-bold">{{ $provinces_count }}</div>
        </div>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-6">What is this election about?</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">The 2026 General Election will determine the 275 members of the House of Representatives. 165 members will be elected through direct voting (FPTP), and 110 will be elected through party-list proportional representation (PR).</p>
            <div class="space-y-4">
                <div class="flex gap-4 p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                    <div class="bg-red-100 text-[#DC143C] p-3 rounded-full h-fit font-bold">FPTP</div>
                    <div>
                        <h4 class="font-bold">First Past The Post</h4>
                        <p class="text-sm text-gray-500">Directly vote for a candidate in your constituency.</p>
                    </div>
                </div>
                <div class="flex gap-4 p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                    <div class="bg-blue-100 text-[#003893] p-3 rounded-full h-fit font-bold">PR</div>
                    <div>
                        <h4 class="font-bold">Proportional Representation</h4>
                        <p class="text-sm text-gray-500">Vote for a party; seats are allocated based on total votes.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('how-it-works') }}" class="inline-block mt-8 text-[#003893] font-bold hover:underline">Learn more about the system &rarr;</a>
        </div>
        <div class="bg-gray-200 aspect-video rounded-2xl flex items-center justify-center relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1540910419892-f0c749013d75?auto=format&fit=crop&w=800&q=80" alt="Nepal Election" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <button class="relative z-10 bg-white p-4 rounded-full shadow-xl">
                <svg class="w-8 h-8 text-[#DC143C]" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
            </button>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-gray-100">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-3xl font-black mb-2">{{ __('messages.major_political_parties') }}</h2>
            <p class="text-gray-500 font-medium">Get to know the parties shaping Nepal's future.</p>
        </div>
        <a href="{{ route('parties.index') }}" class="text-sm font-black uppercase tracking-widest text-[#003893] hover:underline">{{ __('messages.view_all') }} &rarr;</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @foreach($parties as $party)
        <a href="{{ route('parties.show', $party->id) }}" class="p-8 bg-white rounded-[32px] border border-gray-50 shadow-sm hover:shadow-xl hover:border-red-100 transition text-center group flex flex-col items-center">
            <div class="w-16 h-16 rounded-2xl mb-6 flex items-center justify-center overflow-hidden shadow-sm bg-gray-50 group-hover:scale-110 transition duration-500">
                @if($party->logo_image)
                    <img src="{{ $party->logo_image }}" 
                         alt="{{ $party->name }}" 
                         class="w-full h-full object-contain p-2"
                         referrerpolicy="no-referrer"
                         x-data
                         x-on:error="$el.style.display='none'; $el.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-full items-center justify-center font-black text-white text-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                        {{ substr($party->abbreviation, 0, 1) }}
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center font-black text-white text-2xl" style="background-color: {{ $party->color_hex ?? '#333' }}">
                        {{ substr($party->abbreviation, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="font-black text-gray-900 mb-1 tracking-tighter">{{ $party->abbreviation }}</div>
            <div class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-tight line-clamp-1">{{ $party->name }}</div>
        </a>
        @endforeach
    </div>
</section>

<section class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold mb-2">{{ __('messages.featured_constituencies') }}</h2>
                <p class="text-gray-500">Key battlegrounds to watch in 2026.</p>
            </div>
            <a href="{{ route('constituencies.index') }}" class="text-[#003893] font-bold">{{ __('messages.view_all') }} &rarr;</a>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($featured_constituencies as $constituency)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                <div class="p-6">
                    <div class="text-xs font-bold text-gray-400 uppercase mb-1">{{ $constituency->district }} - {{ $constituency->province->name }}</div>
                    <h3 class="text-xl font-bold mb-4">{{ $constituency->name }}</h3>
                    
                    <div class="space-y-3">
                        @foreach($constituency->candidates->sortByDesc('is_incumbent')->take(2) as $candidate)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden shadow-sm bg-gray-200 shrink-0">
                                    <img src="{{ $candidate->photo }}" 
                                         alt="{{ $candidate->name }}" 
                                         class="w-full h-full object-cover"
                                         referrerpolicy="no-referrer"
                                         x-data
                                         x-on:error="$el.src='https://ui-avatars.com/api/?name={{ urlencode($candidate->name) }}&size=128&background=random&color=fff';">
                                </div>
                                <div>
                                    <div class="font-bold text-sm">{{ $candidate->name }}</div>
                                    <div class="text-[10px] text-gray-500 font-bold uppercase">{{ $candidate->party->abbreviation ?? 'INDPT' }}</div>
                                </div>
                            </div>
                            <div class="w-2 h-2 rounded-full" style="background-color: {{ $candidate->party->color_hex ?? '#333' }}"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('constituencies.show', $constituency->id) }}" class="block p-4 text-center border-t text-sm font-bold hover:bg-gray-50">View Battleground</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid md:grid-cols-2 gap-20">
        <div>
            <h2 class="text-3xl font-black mb-10 flex items-center gap-4">
                <span class="w-2 h-8 rounded-full bg-[#DC143C]"></span>
                {{ __('messages.important_dates') }}
            </h2>
            <div class="space-y-8 relative">
                <div class="absolute left-1.5 top-2 bottom-2 w-0.5 bg-gray-100"></div>
                @foreach($timeline as $event)
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1.5 w-3.5 h-3.5 rounded-full border-2 border-white {{ $event->is_completed ? 'bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.4)]' : 'bg-gray-200' }}"></div>
                    <div class="text-[10px] font-black uppercase tracking-widest {{ $event->is_completed ? 'text-green-600' : 'text-gray-400' }} mb-1">
                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                    </div>
                    <h4 class="font-black text-gray-900 mb-2">{{ $event->title }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $event->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-black mb-10 flex items-center gap-4">
                <span class="w-2 h-8 rounded-full bg-[#003893]"></span>
                {{ __('messages.latest_updates') }}
            </h2>
            <div class="space-y-6">
                @foreach($latest_news as $news)
                <a href="{{ route('news.index') }}" class="block group p-6 bg-white rounded-2xl border border-gray-50 hover:border-blue-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-blue-500 mb-2">
                        <span>{{ $news->source }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                        <span class="text-gray-400">{{ $news->published_at->diffForHumans() }}</span>
                    </div>
                    <h4 class="font-bold text-gray-900 group-hover:text-blue-800 transition line-clamp-2 leading-tight">{{ $news->title }}</h4>
                </a>
                @endforeach
                <a href="{{ route('news.index') }}" class="inline-block mt-4 text-sm font-black uppercase tracking-widest text-[#003893] hover:underline">{{ __('messages.view_all') }} &rarr;</a>
            </div>
        </div>
    </div>
</section>

<script>
    function countdown(date) {
        return {
            target: new Date(date).getTime(),
            days: '00',
            hours: '00',
            minutes: '00',
            init() {
                this.update();
                setInterval(() => this.update(), 60000);
            },
            update() {
                let now = new Date().getTime();
                let distance = this.target - now;
                if (distance < 0) return;
                
                this.days = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
            }
        }
    }
</script>
@endsection
