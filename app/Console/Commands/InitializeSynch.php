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
    protected $signature = 'initialize-synch {exchange*} : List of exchanges';

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
        $arguments = $this->arguments()['exchange'];

        if (count($arguments) > 0) {
            $exchanges = collect($arguments);
        } else {
            $exchanges = collect(['USA']);
        }

        $exchanges->each(function($exch) {
            $exchange = Exchange::firstOrCreate(['symbol' => $exch]);
            collect(Http::qfs()->get("/companies/{$exchange->symbol}")->collect()->get('data'))->each(function(string $symbol) use ($exchange) {
                $company = Company::firstOrCreate(['symbol' => $symbol], ['exchange_id' => $exchange->id]);
                SynchronizeStatements::dispatch($company);
            });
        });

    }
}
