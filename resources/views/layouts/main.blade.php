<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="gcPaCfEZymxv37Y-Nk4s5YnhAwcGxI_22GdlydVcGC8" />

    {!! SEO::generate() !!}
    <link rel="canonical" href="{{ url()->current() }}" />
    <x-seo-schema :candidate="$candidate ?? null" :party="$party ?? null" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Inter:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', 'Noto Sans Devanagari', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-900">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-[#DC143C]">NEPAL</span>
                        <span class="text-2xl font-bold text-[#003893]">ELECTION 2026</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('candidates.index') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.candidates') }}</a>
                    <a href="{{ route('compare') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.compare') }}</a>
                    <a href="{{ route('parties.index') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.parties') }}</a>
                    <a href="{{ route('constituencies.index') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.constituencies') }}</a>
                    <a href="{{ route('results.index') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.results') }}</a>
                    <a href="{{ route('how-it-works') }}"
                        class="hover:text-[#DC143C] font-semibold">{{ __('messages.how_it_works') }}</a>
                </div>
                <div class="flex items-center gap-4">
                    @if (app()->getLocale() == 'en')
                        <a href="{{ route('locale.switch', 'ne') }}"
                            class="bg-gray-100 px-3 py-1 rounded text-sm font-bold">नेपाली</a>
                    @else
                        <a href="{{ route('locale.switch', 'en') }}"
                            class="bg-gray-100 px-3 py-1 rounded text-sm font-bold">English</a>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-12 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Nepal Election 2026</h3>
                    <p class="text-gray-400">Your one-stop destination for all information related to Nepal's General
                        Election 2026.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('candidates.index') }}">Candidates</a></li>
                        <li><a href="{{ route('parties.index') }}">Parties</a></li>
                        <li><a href="{{ route('constituencies.index') }}">Constituencies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Help & Info</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('how-it-works') }}">How to Vote</a></li>
                        <li><a href="{{ route('how-it-works') }}">FAQs</a></li>
                        <li><a href="{{ route('news.index') }}">Latest News</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Official Sources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="https://election.gov.np" target="_blank">Election Commission</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Nepal Election 2026. This is an informational prototype. <a
                        href="/admin" class="opacity-0 hover:opacity-100 transition ml-2">Admin</a></p>
            </div>
        </div>
    </footer>
</body>

</html>
