<?php

namespace App\Jobs;

use App\Models\BalanceStatement;
use App\Models\CashFlowStatement;
use App\Models\Company;
use App\Models\IncomeStatement;
use Http;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SynchronizeStatements implements ShouldQueue
{
    private Company $company;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company) {
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Http::fmg()->get("/income-statement/{$this->company->symbol}?period=annual")->collect()->each(function($statement) {
            IncomeStatement::firstOrCreate(['symbol' => $this->company->symbol, 'date' => $statement['date'] ?? null], array_merge($statement, ['company_id' => $this->company->id]));
        });

        Http::fmg()->get("/balance-sheet-statement/{$this->company->symbol}?period=annual")->collect()->each(function($statement) {
            BalanceStatement::firstOrCreate(['symbol' => $this->company->symbol, 'date' => $statement['date'] ?? null], array_merge($statement, ['company_id' => $this->company->id]));
        });

        Http::fmg()->get("/cash-flow-statement/{$this->company->symbol}?period=annual")->collect()->each(function($statement) {
            CashFlowStatement::firstOrCreate(['symbol' => $this->company->symbol, 'date' => $statement['date'] ?? null], array_merge($statement, ['company_id' => $this->company->id]));
        });
    }
}
