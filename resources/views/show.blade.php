<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
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

            <h2 class="text-2xl font-extrabold text-[#d8ae3a] mt-10">{{ $item->name }}</h2>

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
                </div>
            </div>

            <div id="curve_chart" style="width: 300px; height: 300px"></div>

        </main>

        {{-- background --}}
        <div class="fixed top-0 left-0 h-screen w-full z-[-1] bg-[#131219] opacity-80"></div>
        <img class="fixed top-0 left-0 h-screen w-full object-cover z-[-2] object-left-top" src="{{ asset('images/gold-road.jpg') }}" />
        {{-- /background --}}

    </body>

</html>
