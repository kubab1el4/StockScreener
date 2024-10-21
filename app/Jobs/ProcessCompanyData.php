<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\CompanyData;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCompanyData implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Company $company;

    private array $toBeAdded = [];

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    // public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    // public $timeout = 3600;

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
    public function handle(){
        $financials_updated = $this->company->financials_updated;
        $fundamentals = $this->company->fundamental->value['data'] ?? null;
        if (!$fundamentals) {
            $fundamentals = json_decode($this->company->fundamental->value, true)['data'];
        }
        $metadata = $fundamentals['metadata'];
        isset($metadata['full_time_employees']) && is_int($metadata['full_time_employees']) ?: $metadata['full_time_employees'] = null;

        $this->company->update($metadata);

        $quarterlyFinancials = collect($fundamentals['financials']['quarterly']);
        $quarterlyPeriods = array_slice($quarterlyFinancials['period_end_date'], -10);
        $quarterlyFinancials->forget('period_end_date');
        $quarterlyFinancials->each(function($category, $name) use ($quarterlyPeriods) {
            if (is_array($category)) {
                $category = array_slice($category, -10);
                foreach ($category as $key => $value) {
                    !is_array($value) ?: $value = 0;
                    $this->toBeAdded[] = [
                        'period' => $quarterlyPeriods[$key],
                        'company_id' => $this->company->id,
                        'guid' => $name,
                        'type' => 'Q',
                        'value' => $value
                    ];
                }
            } else {
                !is_array($category) ?: $category = 0;
                $this->toBeAdded[] = [
                    'period' => 'SUM',
                    'company_id' => $this->company->id,
                    'guid' => $name,
                    'type' => 'Q',
                    'value' => $category
                ];
            }
        });

        $annualFinancials = collect($fundamentals['financials']['annual']);
        $annualPeriods = array_slice($annualFinancials['period_end_date'], -10);
        $annualFinancials->forget('period_end_date');
        $annualFinancials->each(function($category, $name) use ($annualPeriods) {
            if (is_array($category)) {
                $category = array_slice($category, -10);
                foreach ($category as $key => $value) {
                    !is_array($value) ?: $value = 0;
                    $this->toBeAdded[] = [
                        'period' => $annualPeriods[$key],
                        'company_id' => $this->company->id,
                        'guid' => $name,
                        'type' => 'A',
                        'value' => $value
                    ];
                }
            } else {
                !is_array($category) ?: $category = 0;
                $this->toBeAdded[] = [
                    'period' => 'SUM',
                    'company_id' => $this->company->id,
                    'guid' => $name,
                    'type' => 'A',
                    'value' => $category
                ];
            }
        });

        $ttmFinancials = collect($fundamentals['financials']['ttm'] ?? []);

        if (!empty($ttmFinancials)) {
            $ttmPeriod = "TTM";
            $ttmFinancials->forget('period_end_date');
            $ttmFinancials->each(function($value, $name) use ($ttmPeriod) {
                !is_array($value) ?: $value = 0;
                $this->toBeAdded[] = [
                    'period' => $ttmPeriod,
                    'company_id' => $this->company->id,
                    'guid' => $name,
                    'type' => 'TTM',
                    'value' => $value
                ];
            });
        }
    CompanyData::insert($this->toBeAdded);
    }
}
