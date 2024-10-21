<?php

namespace App\Jobs;

use App\Models\BalanceStatement;
use App\Models\CashFlowStatement;
use App\Models\Company;
use App\Models\Fundamental;
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
        $data = Http::qfs()->get("/data/all-data/{$this->company->symbol}")->json();
        Fundamental::updateOrCreate(['company_id' => $this->company->id], ['value' => $data]);
        ProcessCompanyData::dispatch($this->company);
    }
}
