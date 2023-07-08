<?php

namespace App\Services;

use App\Contracts\CurrencyInterface;
use Illuminate\Support\Facades\Http;

class CurrencyService implements CurrencyInterface
{
    public function getCurrency()
    {
        $response = Http::get('https://api.currencyapi.com/v3/latest?apikey=G73DwMThv8RffZbqyIMukt6AtWVTy06RgpVVcueR')->json();
        dd($response);
    }
}