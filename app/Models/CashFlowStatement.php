<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CashFlowStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'date',
        'symbol',
        'reportedCurrency',
        'cik',
        'fillingDate',
        'acceptedDate',
        'calendarYear',
        'period',
        'netIncome',
        'depreciationAndAmortization',
        'deferredIncomeTax',
        'stockBasedCompensation',
        'changeInWorkingCapital',
        'accountsReceivables',
        'inventory',
        'accountsPayables',
        'otherWorkingCapital',
        'otherNonCashItems',
        'netCashProvidedByOperatingActivities',
        'investmentsInPropertyPlantAndEquipment',
        'acquisitionsNet',
        'purchasesOfInvestments',
        'salesMaturitiesOfInvestments',
        'otherInvestingActivites',
        'netCashUsedForInvestingActivites',
        'debtRepayment',
        'commonStockIssued',
        'commonStockRepurchased',
        'dividendsPaid',
        'otherFinancingActivites',
        'netCashUsedProvidedByFinancingActivities',
        'effectOfForexChangesOnCash',
        'netChangeInCash',
        'cashAtEndOfPeriod',
        'cashAtBeginningOfPeriod',
        'operatingCashFlow',
        'capitalExpenditure',
        'freeCashFlow',
        'link',
        'finalLink',
        'company_id',
    ];

    public function company() : HasOne {
        return $this->hasOne(Company::class);
    }
}
