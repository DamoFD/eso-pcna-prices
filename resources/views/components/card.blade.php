<a href="item/{{$item->id}}" class="bg-slate-700 w-full h-28 flex flex-col items-center justify-center shadow-md shadow-slate-600 rounded-lg">
    <h3 class="text-center font-bold" style="color: @switch($item->quality)
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
    @endswitch">{{ $item->name }}</h3>
    <h3 class="text-center text-[#d8ae3a] font-bold">{{ $item->prices->first()->price ?? 'Price not available' }}</h3>
    @if(isset($item->percentDifference))
        <p class="text-center" style="color: {{ $item->percentDifference >= 0 ? 'green' : 'red' }}">
            {{ $item->percentDifference >= 0 ? '+' : '' }}{{ number_format($item->percentDifference, 2) }}%
        </p>
    @else
        <p class="text-white">Price change data not available</p>
    @endif
    <h3 class="text-center text-white font-bold">Last updated: {{ $item->prices->first()->last_updated ?? 'Not available' }}</h3>
</a>
