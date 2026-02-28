@extends('layouts.main')

@section('content')
<div class="bg-white border-b border-gray-100 py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:w-2/3">
            <h1 class="text-5xl font-black text-gray-900 mb-8 tracking-tighter leading-tight">Election Guide: <br><span class="text-[#003893]">How Nepal Votes</span></h1>
            <p class="text-xl text-gray-500 font-medium leading-relaxed">A simple, beginner-friendly guide to understanding the 2026 General Election and Nepal's political system.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-24">
        <div class="lg:col-span-2 space-y-24">
            <!-- Political System -->
            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-12 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-blue-600"></span>
                    The Electoral System
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#DC143C] font-black text-xl shadow-sm mb-6 border border-gray-100">1</div>
                        <h4 class="text-xl font-black text-gray-900 mb-4">FPTP Seats (165)</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Direct voting where you choose one candidate for your constituency. The candidate with the most votes wins. This is the First-Past-The-Post system.</p>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#003893] font-black text-xl shadow-sm mb-6 border border-gray-100">2</div>
                        <h4 class="text-xl font-black text-gray-900 mb-4">PR Seats (110)</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Proportional Representation. You vote for a political party instead of a person. Seats are shared among parties based on their total national vote share.</p>
                    </div>
                </div>
            </section>

            <!-- FAQs -->
            <section>
                <h2 class="text-3xl font-black text-gray-900 mb-12 flex items-center gap-4">
                    <span class="w-2 h-8 rounded-full bg-yellow-400"></span>
                    Frequently Asked Questions
                </h2>
                <div class="space-y-4" x-data="{ active: null }">
                    @foreach($faqs as $faq)
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                        <button 
                            @click="active = (active === {{ $faq->id }} ? null : {{ $faq->id }})"
                            class="w-full px-8 py-6 text-left flex justify-between items-center group"
                        >
                            <span class="font-black text-gray-900 group-hover:text-blue-800 transition">{{ $faq->question }}</span>
                            <svg 
                                class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                :class="active === {{ $faq->id }} ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div 
                            x-show="active === {{ $faq->id }}" 
                            x-collapse
                            class="px-8 pb-8 text-gray-500 text-sm leading-relaxed"
                        >
                            {{ $faq->answer }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Timeline Sidebar -->
        <aside>
            <div class="bg-gray-900 text-white p-10 rounded-[40px] sticky top-24">
                <h3 class="text-2xl font-black mb-12 flex items-center gap-4">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Election Timeline
                </h3>
                <div class="space-y-12 relative">
                    <div class="absolute left-1.5 top-2 bottom-2 w-0.5 bg-gray-800"></div>
                    @foreach($timeline as $event)
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1.5 w-3.5 h-3.5 rounded-full border-2 border-gray-900 {{ $event->is_completed ? 'bg-green-500' : 'bg-gray-700' }}"></div>
                        <div class="text-[10px] font-black uppercase tracking-widest {{ $event->is_completed ? 'text-green-500' : 'text-gray-500' }} mb-2">
                            {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                        </div>
                        <h4 class="font-black text-lg mb-2 {{ $event->is_completed ? 'text-white' : 'text-gray-300' }}">{{ $event->title }}</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $event->description }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-16 pt-16 border-t border-gray-800">
                    <h4 class="font-black text-white mb-4">Need Help?</h4>
                    <p class="text-sm text-gray-500 mb-8">Contact the Election Commission hotline for voter registration queries.</p>
                    <div class="flex items-center gap-4 font-black text-blue-500 text-xl tracking-tighter">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        1660-01-44444
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
