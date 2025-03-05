<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class CurrencyRateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();
        $response = $client->get('https://open.er-api.com/v6/latest/USD');

        $rates = json_decode($response->getBody()->getContents(), true);

        Cache::store('redis')->put(config('currency.cache_key'), $rates, now()->addDay());
    }
}
