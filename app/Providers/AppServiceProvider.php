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
        // $apiCall = ApiCall::firstOrCreate(['date' => date('Y-m-d')], ['use_count' => 0]);
        // $this->app->instance(ApiCall::class, $apiCall);

        Http::macro('qfs', function () {
            $apiCall = resolve(ApiCall::class);

            if ($apiCall->use_count === 25000) {
                exit;
            }

            $apiCall->update(['use_count' => $apiCall->use_count + 1]);

            return Http::baseUrl('https://public-api.quickfs.net/v1/')->withOptions(['query' => ['api_key' => config('app.qfs_api_key')]]);
        });
    }
}
