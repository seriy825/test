<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Jobs\CurrencyRateJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CurrencyRateController extends ApiController
{
    public function index()
    {
        $response = Cache::get(config('currency.cache_key'));
        if (!isset($response)) {
            return $this->responseError('Currency rates not found in cache', 404);
        }
        return $this->responseSuccess(compact('response'));
    }
}
