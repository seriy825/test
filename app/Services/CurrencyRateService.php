<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class CurrencyRateService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchRates(): array
    {
        $response = $this->client->get('https://open.er-api.com/v6/latest/USD');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function updateRates(): array
    {
        $rates = $this->fetchRates();
        Cache::store('redis')->put(config('currency.cache_key'), $rates, now()->addDay());

        return $rates;
    }
}
