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

            <h2 class="text-2xl font-extrabold text-[#d8ae3a] mt-10">Create an Item</h2>

            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('update', ['id' => $item->id]) }}" method="POST" class="flex flex-col space-y-4 w-11/12 mt-4 pb-10">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label for="name" class="text-[#d8ae3a] text-lg font-bold">Item Name</label>
                    <input value="{{ $item->name }}" id="name" name="name" type="text" placeholder="ex: Dreugh Wax" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]" />
                </div>
                <div class="flex flex-col">
                    <label for="trait" class="text-[#d8ae3a] text-lg font-bold">Trait</label>
                    <select name="trait" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="">None</option>
                        <option value="1" {{ $item->trait == '1' ? 'selected' : '' }}>Aggressive</option>
                        <option value="2" {{ $item->trait == '2' ? 'selected' : '' }}>Arcane</option>
                        <option value="3" {{ $item->trait == '3' ? 'selected' : '' }}>Augmented</option>
                        <option value="4" {{ $item->trait == '4' ? 'selected' : '' }}>Bloodthirsty</option>
                        <option value="5" {{ $item->trait == '5' ? 'selected' : '' }}>Bolstered</option>
                        <option value="6" {{ $item->trait == '6' ? 'selected' : '' }}>Charged</option>
                        <option value="7" {{ $item->trait == '7' ? 'selected' : '' }}>Decisive</option>
                        <option value="8" {{ $item->trait == '8' ? 'selected' : '' }}>Defending</option>
                        <option value="9" {{ $item->trait == '9' ? 'selected' : '' }}>Divines</option>
                        <option value="10" {{ $item->trait == '10' ? 'selected' : '' }}>Focused</option>
                        <option value="11" {{ $item->trait == '11' ? 'selected' : '' }}>Harmony</option>
                        <option value="12" {{ $item->trait == '12' ? 'selected' : '' }}>Healthy</option>
                        <option value="13" {{ $item->trait == '13' ? 'selected' : '' }}>Impenetrable</option>
                        <option value="14" {{ $item->trait == '14' ? 'selected' : '' }}>Infused</option>
                        <option value="15" {{ $item->trait == '15' ? 'selected' : '' }}>Infused</option>
                        <option value="16" {{ $item->trait == '16' ? 'selected' : '' }}>Infused</option>
                        <option value="17" {{ $item->trait == '17' ? 'selected' : '' }}>Intricate</option>
                        <option value="18" {{ $item->trait == '18' ? 'selected' : '' }}>Invigorating</option>
                        <option value="19" {{ $item->trait == '19' ? 'selected' : '' }}>Nirnhoned</option>
                        <option value="20" {{ $item->trait == '20' ? 'selected' : '' }}>Nirnhoned</option>
                        <option value="21" {{ $item->trait == '21' ? 'selected' : '' }}>Ornate</option>
                        <option value="22" {{ $item->trait == '22' ? 'selected' : '' }}>Powered</option>
                        <option value="23" {{ $item->trait == '23' ? 'selected' : '' }}>Prolific</option>
                        <option value="24" {{ $item->trait == '24' ? 'selected' : '' }}>Protective</option>
                        <option value="25" {{ $item->trait == '25' ? 'selected' : '' }}>Quickened</option>
                        <option value="26" {{ $item->trait == '26' ? 'selected' : '' }}>Reinforced</option>
                        <option value="27" {{ $item->trait == '27' ? 'selected' : '' }}>Robust</option>
                        <option value="28" {{ $item->trait == '28' ? 'selected' : '' }}>Shattering</option>
                        <option value="29" {{ $item->trait == '29' ? 'selected' : '' }}>Sharpened</option>
                        <option value="30" {{ $item->trait == '30' ? 'selected' : '' }}>Soothing</option>
                        <option value="31" {{ $item->trait == '31' ? 'selected' : '' }}>Sturdy</option>
                        <option value="32" {{ $item->trait == '32' ? 'selected' : '' }}>Swift</option>
                        <option value="33" {{ $item->trait == '33' ? 'selected' : '' }}>Training</option>
                        <option value="34" {{ $item->trait == '34' ? 'selected' : '' }}>Triune</option>
                        <option value="35" {{ $item->trait == '35' ? 'selected' : '' }}>Vigorous</option>
                        <option value="36" {{ $item->trait == '36' ? 'selected' : '' }}>Well-fitted</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="quality" class="text-[#d8ae3a] text-lg font-bold">Quality</label>
                    <select id="quality" name="quality" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="1" {{ $item->quality == '1' ? 'selected' : '' }}>Normal</option>
                        <option value="2" {{ $item->quality == '2' ? 'selected' : '' }}>Fine</option>
                        <option value="3" {{ $item->quality == '3' ? 'selected' : '' }}>Superior</option>
                        <option value="4" {{ $item->quality == '4' ? 'selected' : '' }}>Epic</option>
                        <option value="5" {{ $item->quality == '5' ? 'selected' : '' }}>Legendary</option>
                    </select>
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
