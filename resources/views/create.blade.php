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

            <form action="{{ route('store') }}" method="POST" class="flex flex-col space-y-4 w-11/12 mt-4 pb-10">
                @csrf
                <div class="flex flex-col">
                    <label for="name" class="text-[#d8ae3a] text-lg font-bold">Item Name</label>
                    <input id="name" name="name" type="text" placeholder="ex: Dreugh Wax" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]" />
                </div>
                <div class="flex flex-col">
                    <label for="trait" class="text-[#d8ae3a] text-lg font-bold">Trait</label>
                    <select id="trait" name="trait" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="">None</option>
                        <option value="1">Aggressive</option>
                        <option value="2">Arcane</option>
                        <option value="3">Augmented</option>
                        <option value="4">Bloodthirsty</option>
                        <option value="5">Bolstered</option>
                        <option value="6">Charged</option>
                        <option value="7">Decisive</option>
                        <option value="8">Defending</option>
                        <option value="9">Divines</option>
                        <option value="10">Focused</option>
                        <option value="11">Harmony</option>
                        <option value="12">Healthy</option>
                        <option value="13">Impenetrable</option>
                        <option value="14">Infused</option>
                        <option value="15">Infused</option>
                        <option value="16">Infused</option>
                        <option value="17">Intricate</option>
                        <option value="18">Invigorating</option>
                        <option value="19">Nirnhoned</option>
                        <option value="20">Nirnhoned</option>
                        <option value="21">Ornate</option>
                        <option value="22">Powered</option>
                        <option value="23">Prolific</option>
                        <option value="24">Protective</option>
                        <option value="25">Quickened</option>
                        <option value="26">Reinforced</option>
                        <option value="27">Robust</option>
                        <option value="28">Shattering</option>
                        <option value="29">Sharpened</option>
                        <option value="30">Soothing</option>
                        <option value="31">Sturdy</option>
                        <option value="32">Swift</option>
                        <option value="33">Training</option>
                        <option value="34">Triune</option>
                        <option value="35">Vigorous</option>
                        <option value="36">Well-fitted</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="quality" class="text-[#d8ae3a] text-lg font-bold">Quality</label>
                    <select id="quality" name="quality" class="h-10 block rounded-lg bg-slate-700 text-[#d8ae3a]">
                        <option value="1">Normal</option>
                        <option value="2">Fine</option>
                        <option value="3">Superior</option>
                        <option value="4">Epic</option>
                        <option value="5">Legendary</option>
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
