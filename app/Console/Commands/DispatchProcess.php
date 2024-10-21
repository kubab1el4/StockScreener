<?php

namespace App\Console\Commands;

use App\Jobs\ProcessCompanyData;
use App\Models\Company;
use Illuminate\Console\Command;

class DispatchProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs for processing all company data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void{
        $companies = Company::all();
        $companies->each(function($company) {
            ProcessCompanyData::dispatch($company);
        });
    }
}
