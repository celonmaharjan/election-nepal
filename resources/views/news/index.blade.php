@extends('layouts.main')

@section('content')
<div class="bg-white border-b border-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Election News</h1>
        <p class="text-lg text-gray-500 font-medium mt-4">The latest updates, debates, and announcements from the 2026 campaign trail.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <div class="lg:col-span-2 space-y-12">
            <!-- Search News -->
            <form action="{{ route('news.index') }}" method="GET" class="mb-12 relative group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search news stories..." class="w-full pl-14 pr-6 py-5 bg-white rounded-[32px] border-gray-100 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent font-bold text-lg transition-all">
                <svg class="w-6 h-6 absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-hover:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                @if(request('search'))
                    <a href="{{ route('news.index') }}" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 font-bold text-sm">Clear</a>
                @endif
            </form>

            @forelse($articles as $article)
            <article class="group">
                <a href="{{ $article->source_url }}" target="_blank" class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-64 h-48 bg-gray-100 rounded-2xl overflow-hidden shrink-0">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-[#003893] mb-4">
                            <span>{{ $article->source }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span class="text-gray-400">{{ $article->published_at ? $article->published_at->diffForHumans() : '' }}</span>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 group-hover:text-blue-800 transition mb-4 leading-tight tracking-tight">{{ $article->title }}</h2>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ $article->summary }}</p>
                    </div>
                </a>
            </article>
            @empty
            <div class="py-20 text-center border-2 border-dashed border-gray-100 rounded-[40px]">
                <p class="text-gray-400 font-medium italic text-lg">No news articles found at the moment.</p>
            </div>
            @endforelse

            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        </div>

        <aside class="space-y-12">
            <div class="bg-gray-50 p-8 rounded-[40px] border border-gray-100">
                <h3 class="text-xl font-black text-gray-900 mb-8">Follow the Campaign</h3>
                <div class="space-y-6">
                    <p class="text-sm text-gray-500 leading-relaxed">Stay updated on social media for real-time election announcements and results.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#1DA1F2] hover:shadow-md transition">X</a>
                        <a href="#" class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#4267B2] hover:shadow-md transition">FB</a>
                        <a href="#" class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#E1306C] hover:shadow-md transition">IG</a>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
