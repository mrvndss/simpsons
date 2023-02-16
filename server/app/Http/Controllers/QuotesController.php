<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;

class QuotesController extends Controller
{
    protected $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function index()
    {
        return $this->quoteService->getQuotes();
    }
}
