<?php

namespace App\Console\Commands;

use App\Jobs\SynchronizeStatements;
use App\Models\Company;
use App\Models\Exchange;
use Http;
use Illuminate\Console\Command;

class InitializeSynch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize-synch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize api synch';

    /**
     * Execute the console command.
     */
    public function handle() {
        $exchanges = Http::fmg()->get('/exchanges-list')->collect();

        $exchanges->each(function($exch) {
            $exchange = Exchange::firstOrCreate(['symbol' => $exch]);

            Http::fmg()->get("/symbol/{$exchange->symbol}")->collect()->each(function($company) use ($exchange) {
                $company = Company::firstOrCreate(['symbol' => $company['symbol'] ?? null, 'name' => $company['name'] ?? null], ['exchange_id' => $exchange->id]);
                SynchronizeStatements::dispatch($company);
            });
        });

    }
}
