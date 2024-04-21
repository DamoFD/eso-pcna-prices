<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="relative w-full">
        <main class="w-full flex flex-col items-center justify-center pt-12">
            <p class="text-white">Welcome {{ auth()->user()->name }}</p>

            <a href="/">
                <h1 class="text-4xl font-extrabold text-[#d8ae3a]">ESO PSNA Prices</h1>
            </a>

            {{-- Search !--}}
            <form class="flex mt-10" action="{{ route('search') }}" method="GET">
                <input value="{{ request()->query('query', '') }}" name="query" placeholder="search for item" type="search" class="text-center h-10 block rounded-l-lg bg-slate-700 text-[#d8ae3a]" />
                <button type="submit" class="bg-[#d8ae3a] h-10 w-14 font-bold text-gray-800 rounded-r-lg">Search</button>
            </form>
            {{-- /Search !--}}

            <h2 class="text-2xl font-extrabold text-[#d8ae3a] mt-10">Trending</h2>

            <div class="flex flex-col space-y-4 w-11/12 mt-4 overflow-y-auto pb-10">
                @foreach ($items as $item)
                    <x-card :item="$item" />
                @endforeach
            </div>

        </main>

        {{-- background --}}
        <div class="fixed top-0 left-0 h-screen w-full z-[-1] bg-[#131219] opacity-80"></div>
        <img class="fixed top-0 left-0 h-screen w-full object-cover z-[-2] object-left-top" src="{{ asset('images/gold-road.jpg') }}" />
        {{-- /background --}}

    </body>
</html>
