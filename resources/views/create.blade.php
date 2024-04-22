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

            <form action="{{ route('store') }}" method="POST" class="flex flex-col space-y-4 w-11/12 mt-4 pb-10">
                @csrf
                <div class="flex flex-col">
                    <label for="name" class="text-[#d8ae3a] text-lg font-bold">Item Name</label>
                    <input value="{{ old('name') }}" id="name" name="name" type="text" placeholder="ex: Dreugh Wax" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]" />
                </div>
                <div class="flex flex-col">
                    <label for="trait" class="text-[#d8ae3a] text-lg font-bold">Trait</label>
                    <select name="trait" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="">None</option>
                        <option value="1" {{ old('trait') == '1' ? 'selected' : '' }}>Aggressive</option>
                        <option value="2" {{ old('trait') == '2' ? 'selected' : '' }}>Arcane</option>
                        <option value="3" {{ old('trait') == '3' ? 'selected' : '' }}>Augmented</option>
                        <option value="4" {{ old('trait') == '4' ? 'selected' : '' }}>Bloodthirsty</option>
                        <option value="5" {{ old('trait') == '5' ? 'selected' : '' }}>Bolstered</option>
                        <option value="6" {{ old('trait') == '6' ? 'selected' : '' }}>Charged</option>
                        <option value="7" {{ old('trait') == '7' ? 'selected' : '' }}>Decisive</option>
                        <option value="8" {{ old('trait') == '8' ? 'selected' : '' }}>Defending</option>
                        <option value="9" {{ old('trait') == '9' ? 'selected' : '' }}>Divines</option>
                        <option value="10" {{ old('trait') == '10' ? 'selected' : '' }}>Focused</option>
                        <option value="11" {{ old('trait') == '11' ? 'selected' : '' }}>Harmony</option>
                        <option value="12" {{ old('trait') == '12' ? 'selected' : '' }}>Healthy</option>
                        <option value="13" {{ old('trait') == '13' ? 'selected' : '' }}>Impenetrable</option>
                        <option value="14" {{ old('trait') == '14' ? 'selected' : '' }}>Infused</option>
                        <option value="15" {{ old('trait') == '15' ? 'selected' : '' }}>Infused</option>
                        <option value="16" {{ old('trait') == '16' ? 'selected' : '' }}>Infused</option>
                        <option value="17" {{ old('trait') == '17' ? 'selected' : '' }}>Intricate</option>
                        <option value="18" {{ old('trait') == '18' ? 'selected' : '' }}>Invigorating</option>
                        <option value="19" {{ old('trait') == '19' ? 'selected' : '' }}>Nirnhoned</option>
                        <option value="20" {{ old('trait') == '20' ? 'selected' : '' }}>Nirnhoned</option>
                        <option value="21" {{ old('trait') == '21' ? 'selected' : '' }}>Ornate</option>
                        <option value="22" {{ old('trait') == '22' ? 'selected' : '' }}>Powered</option>
                        <option value="23" {{ old('trait') == '23' ? 'selected' : '' }}>Prolific</option>
                        <option value="24" {{ old('trait') == '24' ? 'selected' : '' }}>Protective</option>
                        <option value="25" {{ old('trait') == '25' ? 'selected' : '' }}>Quickened</option>
                        <option value="26" {{ old('trait') == '26' ? 'selected' : '' }}>Reinforced</option>
                        <option value="27" {{ old('trait') == '27' ? 'selected' : '' }}>Robust</option>
                        <option value="28" {{ old('trait') == '28' ? 'selected' : '' }}>Shattering</option>
                        <option value="29" {{ old('trait') == '29' ? 'selected' : '' }}>Sharpened</option>
                        <option value="30" {{ old('trait') == '30' ? 'selected' : '' }}>Soothing</option>
                        <option value="31" {{ old('trait') == '31' ? 'selected' : '' }}>Sturdy</option>
                        <option value="32" {{ old('trait') == '32' ? 'selected' : '' }}>Swift</option>
                        <option value="33" {{ old('trait') == '33' ? 'selected' : '' }}>Training</option>
                        <option value="34" {{ old('trait') == '34' ? 'selected' : '' }}>Triune</option>
                        <option value="35" {{ old('trait') == '35' ? 'selected' : '' }}>Vigorous</option>
                        <option value="36" {{ old('trait') == '36' ? 'selected' : '' }}>Well-fitted</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="quality" class="text-[#d8ae3a] text-lg font-bold">Quality</label>
                    <select id="quality" name="quality" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="1" {{ old('quality') == '1' ? 'selected' : '' }}>Normal</option>
                        <option value="2" {{ old('quality') == '2' ? 'selected' : '' }}>Fine</option>
                        <option value="3" {{ old('quality') == '3' ? 'selected' : '' }}>Superior</option>
                        <option value="4" {{ old('quality') == '4' ? 'selected' : '' }}>Epic</option>
                        <option value="5" {{ old('quality') == '5' ? 'selected' : '' }}>Legendary</option>
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
