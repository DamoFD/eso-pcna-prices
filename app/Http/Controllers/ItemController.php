<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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
}
