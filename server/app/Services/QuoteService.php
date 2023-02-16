<?php

namespace App\Services;

use App\Models\Quote;
use Illuminate\Support\Facades\Http;

class QuoteService
{
    public function getQuotes()
    {
        $this->getQuoteFromApi();
        $quotes = Quote::orderBy('created_at', 'desc')->get();

        // If we have more than 5 quotes, delete the oldest one
        if ($quotes->count() >= 5) {
            $oldestQuote = $quotes->sortBy('created_at')->first();
            $oldestQuote->delete();
        }

        return $quotes;
    }

    public function getQuoteFromApi()
    {
        $response = Http::get('https://thesimpsonsquoteapi.glitch.me/quotes');
        $quote = $response->json()[0];

        Quote::create([
            'quote' => $quote['quote'],
            'character' => $quote['character'],
            'image' => $quote['image'],
            'characterDirection' => $quote['characterDirection']
        ]);

        return $quote;
    }
}
