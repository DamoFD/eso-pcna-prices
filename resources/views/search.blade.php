<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Cooking Guild PSNA Prices</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative w-full">

        <header class="fixed top-0 left-0 w-full py-2 px-2 flex justify-between bg-gradient-to-b from-black to-[rgba(0,0,0,0.1)] z-20">
                <a href="{{ route('home') }}" class="text-[#d8ae3a] font-extrabold">The Cooking Guild</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-white font-bold">Logout</button>
            </form>
        </header>

        <main class="w-full flex flex-col items-center justify-center pt-12">

            <a href="/">
                <h1 class="text-4xl font-extrabold text-[#d8ae3a]">ESO PSNA Prices</h1>
            </a>

            {{-- Search !--}}
            <form class="flex mt-10" action="{{ route('search') }}" method="GET">
                <input value="{{ request()->query('query', '') }}" name="query" placeholder="search for item" type="search" class="text-center h-10 block rounded-l-lg bg-slate-700 text-[#d8ae3a]" />
                <button type="submit" class="bg-[#d8ae3a] h-10 w-14 font-bold text-gray-800 rounded-r-lg">Search</button>
            </form>
            {{-- /Search !--}}

            <h2 class="text-2xl font-extrabold text-[#d8ae3a] mt-10">Results</h2>

            <div class="flex flex-col space-y-4 w-11/12 mt-4 overflow-y-auto pb-10">
                @if ($items->isNotEmpty())
                    @foreach ($items as $item)
                        <x-card :item="$item" />
                    @endforeach
                @endif
                    <p class="text-center text-gray-200 font-bold text-lg">Couldn't find what you were looking for? Notify a developer!</p>
                    @if (auth()->user()->developer == 1)
                        <a href="{{ route('create') }}" class="text-slate-800 font-extrabold bg-[#d8ae3a] rounded-lg px-4 py-2 text-center">Create Item</a>
                    @endif
            </div>

        </main>

        {{-- background --}}
        <div class="fixed top-0 left-0 h-screen w-full z-[-1] bg-[#131219] opacity-80"></div>
        <img class="fixed top-0 left-0 h-screen w-full object-cover z-[-2] object-left-top" src="{{ asset('images/gold-road.jpg') }}" />
        {{-- /background --}}

    </body>
</html>
