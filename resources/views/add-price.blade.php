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

            <a href="/">
                <h1 class="text-4xl font-extrabold text-[#d8ae3a]">ESO PSNA Prices</h1>
            </a>

            {{-- Search !--}}
            <form class="flex mt-10" action="{{ route('search') }}" method="GET">
                <input value="{{ request()->query('query', '') }}" name="query" placeholder="search for item" type="search" class="text-center h-10 block rounded-l-lg bg-slate-700 text-[#d8ae3a]" />
                <button type="submit" class="bg-[#d8ae3a] h-10 w-14 font-bold text-gray-800 rounded-r-lg">Search</button>
            </form>
            {{-- /Search !--}}

            <h2 class="text-2xl font-extrabold text-[#d8ae3a] mt-10">Adding price to {{ $item->name }}</h2>

            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('store.price', ['id' => $item->id]) }}" method="POST" class="flex flex-col space-y-4 w-11/12 mt-4 pb-10">
                @csrf
                <div class="flex flex-col">
                    <label for="price" class="text-[#d8ae3a] text-lg font-bold">Price</label>
                    <input id="price" name="price" type="number" placeholder="1000" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]" />
                </div>
                <div class="w-full pt-10">
                    <button type="submit" class="bg-[#d8ae3a] w-full text-gray-900 text-lg rounded-lg h-14 font-bold">Submit</button>
                </div>
            </form>

        </main>

        {{-- background --}}
        <div class="fixed top-0 left-0 h-screen w-full z-[-1] bg-[#131219] opacity-80"></div>
        <img class="fixed top-0 left-0 h-screen w-full object-cover z-[-2] object-left-top" src="{{ asset('images/gold-road.jpg') }}" />
        {{-- /background --}}

    </body>
</html>
