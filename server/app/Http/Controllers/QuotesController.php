<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Support\Facades\Http;

class QuotesController extends Controller
{

    public function index()
    {
        // get single quote from Simpsons API
        $quote = Http::get('https://thesimpsonsquoteapi.glitch.me/quotes');
        $quote = $quote->json()[0];
        $quote = [
            'quote' => $quote['quote'],
            'character' => $quote['character'],
            'image' => $quote['image'],
            'characterDirection' => $quote['characterDirection']
        ];

        $quotes = Quote::all();

        // delete oldest quote if there are more than 5 quotes
        if (count($quotes) >= 5) {
            $oldestQuote = $quotes->sortBy('created_at')->first();
            $oldestQuote->delete();
        }

        Quote::create($quote);
        $quotes = Quote::all();

        return response()->json($quotes);
    }
}
