<?php

namespace App\Providers;

use App\Models\ApiCall;
use Carbon\Carbon;
use Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $apiCall = ApiCall::firstOrCreate(['date' => date('Y-m-d')], ['use_count' => 0]);
        $this->app->instance(ApiCall::class, $apiCall);

        Http::macro('fmg', function () {
            $apiCall = resolve(ApiCall::class);
            $apiCall->update(['use_count' => $apiCall->use_count + 1]);
            return Http::baseUrl('https://financialmodelingprep.com/api/v3')->withOptions(['query' => ['apikey' => config('app.fmg_api_key')]]);
        });
    }
}
