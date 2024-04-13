<a href="item/{{$item->id}}" class="bg-slate-700 w-full h-24 flex flex-col items-center justify-center shadow-md shadow-slate-600 rounded-lg">
    <h3 class="text-center text-[#d8ae3a] font-bold">{{ $item->name }}</h3>
    <h3 class="text-center text-[#d8ae3a] font-bold">{{ $item->prices->first()->price ?? 'Price not available' }}</h3>
    @if(isset($item->percentDifference))
        <p class="text-center" style="color: {{ $item->percentDifference >= 0 ? 'green' : 'red' }}">
            {{ $item->percentDifference >= 0 ? '+' : '' }}{{ number_format($item->percentDifference, 2) }}%
        </p>
    @else
        <p class="text-white">Price change data not available</p>
    @endif
</a>
