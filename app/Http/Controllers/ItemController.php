<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Price;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['prices' => function($query) {
            $query->orderBy('updated_at', 'desc')->take(2); // Ensure only the two most recent prices are loaded
        }])->get();

        $items->transform(function ($item) {
            $recentPrice = $item->prices->first();
            $previousPrice = $item->prices->skip(1)->first();

            $percentDifference = null;
            if ($recentPrice && $previousPrice) {
                $percentDifference = (($recentPrice->price - $previousPrice->price) / $previousPrice->price) * 100;
            }
            $item->percentDifference = $percentDifference;
            return $item;
        });

        // Order by absolute value of percentDifference in descending order
        $items = $items->sort(function ($a, $b) {
            return abs($b->percentDifference) <=> abs($a->percentDifference);
        });

        return view('home', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with('prices')->where('id', $id)->first();

        $recentPrice = $item->prices->first();
        $previousPrice = $item->prices->skip(1)->first();

        $percentDifference = null;
        if ($recentPrice && $previousPrice) {
            $percentDifference = (($recentPrice->price - $previousPrice->price) / $previousPrice->price) * 100;
            $item->percentDifference = $percentDifference;
        }

        $priceData = $item->prices->sortBy('created_at')->map(function ($price) {
            return ['x' => $price->created_at->toDateString(), 'y' => $price->price];
        });

        return view('show', compact('item', 'priceData'));
    }

    public function search(Request $request)
        {
            // Retrieve the search query from the request (e.g., from a search form)
            $query = $request->input('query');

            // Query the database with a condition based on the search term
            $items = Item::where('name', 'like', '%' . $query . '%')
                ->with(['prices' => function($q) {
                    $q->orderBy('updated_at', 'desc')->take(2); // Only load the two most recent prices
                }])->get();

            $items->transform(function ($item) {
                $recentPrice = $item->prices->first();
                $previousPrice = $item->prices->skip(1)->first();

                $percentDifference = null;
                if ($recentPrice && $previousPrice) {
                    $percentDifference = (($recentPrice->price - $previousPrice->price) / $previousPrice->price) * 100;
                }
                $item->percentDifference = $percentDifference;
                return $item;
            });

            // Order by absolute value of percentDifference in descending order
            $items = $items->sort(function ($a, $b) {
                return abs($b->percentDifference) <=> abs($a->percentDifference);
            });

            return view('search', compact('items'));
        }

    public function create()
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        return view('create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|unique:items',
            'trait' => 'nullable|integer|min:0|max:36',
            'quality' => 'required|integer|min:1|max:5'
        ]);

        $item = new Item();
        $item->user_id = auth()->user()->id;
        $item->name = $validatedData['name'];
        $item->trait = $validatedData['trait'];
        $item->quality = $validatedData['quality'];
        $item->save();

        return redirect()->route('show', ['id' => $item->id]);
    }

    public function edit($id)
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        $item = Item::where('id', $id)->first();
        return view('edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|unique:items,name,' . $id,
            'trait' => 'nullable|integer|min:0|max:36',
            'quality' => 'required|integer|min:1|max:5'
        ]);

        $item = Item::findOrFail($id);
        $item->user_id = auth()->user()->id;
        $item->name = $validatedData['name'];
        $item->trait = $validatedData['trait'];
        $item->quality = $validatedData['quality'];
        $item->save();

        return redirect()->route('show', ['id' => $item->id]);
    }

    public function addPrice($id)
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        $item = Item::where('id', $id)->first();
        return view('add-price', compact('item'));
    }

    public function storePrice(Request $request, $id)
    {
        if (auth()->user()->developer != 1) {
            return redirect()->route('home');
        }

        $validatedData = $request->validate([
            'price' => 'required|integer|min:1|max:10000000000'
        ]);

        $price = new Price();
        $price->user_id = auth()->user()->id;
        $price->price = $validatedData['price'];
        $price->item_id = $id;
        $price->save();

        return redirect()->route('show', ['id' => $id]);
    }
}
