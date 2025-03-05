<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Jobs\CurrencyRateJob;
use App\Services\CurrencyRateService;
use Illuminate\Support\Facades\Cache;

class CurrencyRateController extends ApiController
{
    protected CurrencyRateService $currencyRateService;

    public function __construct(CurrencyRateService $currencyRateService)
    {
        $this->currencyRateService = $currencyRateService;
    }
    public function index()
    {
        $response = Cache::get(config('currency.cache_key'));
        if (!isset($response)) {
            $response = $this->currencyRateService->updateRates();
            if (!isset($response)) {
                return $this->responseError('Currency rates are not available now, try again later', 404);
            }
        }
        return $this->responseSuccess($response);
    }
}
