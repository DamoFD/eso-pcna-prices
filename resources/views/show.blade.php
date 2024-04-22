<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Cooking Guild PSNA Prices</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            data.addColumn('number', 'Price');

            data.addRows([
                @foreach ($item->prices as $price)
                    [new Date('{{ $price->created_at }}'), {{ $price->price }}],
                @endforeach
            ]);

            var options = {
                title: 'Price History',
                legend: { position: 'bottom' },
                hAxis: {
                    title: 'Time',
                    format: 'MMM dd, yyyy',
                    gridlines: {count: 15}
                },
                vAxis: {
                    title: 'Price'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
    </script>
    </head>
    <body class="relative w-full">

        <header class="fixed top-0 left-0 w-full py-2 px-2 flex justify-between bg-gradient-to-b from-black to-[rgba(0,0,0,0.1)]">
                <a href="{{ route('home') }}" class="text-[#d8ae3a] font-extrabold">The Cooking Guild</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-white font-bold">Logout</button>
            </form>
        </header>

        <main class="w-full flex flex-col items-center justify-center pt-12">

            <p class="text-white font-bold">Welcome {{ auth()->user()->name }}</p>

            <a href="/">
                <h1 class="text-4xl font-extrabold text-[#d8ae3a]">ESO PSNA Prices</h1>
            </a>

            {{-- Search !--}}
            <form class="flex mt-10" action="{{ route('search') }}" method="GET">
                <input value="{{ request()->query('query', '') }}" name="query" placeholder="search for item" type="search" class="text-center h-10 block rounded-l-lg bg-slate-700 text-[#d8ae3a]" />
                <button type="submit" class="bg-[#d8ae3a] h-10 w-14 font-bold text-gray-800 rounded-r-lg">Search</button>
            </form>
            {{-- /Search !--}}

            <h2 class="text-2xl font-extrabold mt-10" style="color: @switch($item->quality)
                @case(1)
                    #FFFFFF; {{-- White for Normal --}}
                    @break
                @case(2)
                    #2DC50E; {{-- Green for Fine --}}
                    @break
                @case(3)
                    #3A92FF; {{-- Blue for Superior --}}
                    @break
                @case(4)
                    #A02EF7; {{-- Purple for Epic --}}
                    @break
                @case(5)
                    #FFAA1A; {{-- Gold for Legendary --}}
                    @break
                @default
                    #FFFFFF; {{-- Default color if none of the above --}}
            @endswitch">{{ $item->name }}</h2>

            <div class="flex flex-col space-y-4 w-11/12 mt-4 overflow-y-auto pb-10">
                <div class="bg-slate-700 w-full h-24 flex flex-col items-center justify-center shadow-md shadow-slate-600 rounded-lg">
                    <h3 class="text-center text-[#d8ae3a] font-bold">{{ $item->prices->first()->price ?? 'Price not available' }}</h3>
                    @if(isset($item->percentDifference))
                        <p class="text-center" style="color: {{ $item->percentDifference >= 0 ? 'green' : 'red' }}">
                            {{ $item->percentDifference >= 0 ? '+' : '' }}{{ number_format($item->percentDifference, 2) }}%
                        </p>
                    @else
                        <p class="text-white">Price change data not available</p>
                    @endif
                    <h3 class="text-center text-white font-bold">Last updated: {{ optional($item->prices->first())->updated_at?->diffForHumans() ?? 'Not available' }}</h3>
                </div>
            </div>

            @if (auth()->user()->developer == 1)
                <div>
                    <a href="{{ route('add.price', ['id' => $item->id]) }}" class="text-slate-800 font-extrabold bg-[#d8ae3a] rounded-lg px-4 py-2">Add Price</a>
                </div>
            @endif

            <div id="curve_chart" style="width: 300px; height: 300px" class="my-10"></div>

            @if (auth()->user()->developer == 1)
                <a href="{{ route('edit', ['id' => $item->id]) }}" class="text-slate-800 font-extrabold bg-[#d8ae3a] rounded-lg px-4 py-2">Edit Item</a>
            @endif

        </main>

        {{-- background --}}
        <div class="fixed top-0 left-0 h-screen w-full z-[-1] bg-[#131219] opacity-80"></div>
        <img class="fixed top-0 left-0 h-screen w-full object-cover z-[-2] object-left-top" src="{{ asset('images/gold-road.jpg') }}" />
        {{-- /background --}}

    </body>

</html>
