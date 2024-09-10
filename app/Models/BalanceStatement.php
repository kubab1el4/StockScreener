<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BalanceStatement extends Model
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
        'cashAndCashEquivalents',
        'shortTermInvestments',
        'cashAndShortTermInvestments',
        'netReceivables',
        'inventory',
        'otherCurrentAssets',
        'totalCurrentAssets',
        'propertyPlantEquipmentNet',
        'goodwill',
        'intangibleAssets',
        'goodwillAndIntangibleAssets',
        'longTermInvestments',
        'taxAssets',
        'otherNonCurrentAssets',
        'totalNonCurrentAssets',
        'otherAssets',
        'totalAssets',
        'accountPayables',
        'shortTermDebt',
        'taxPayables',
        'deferredRevenue',
        'otherCurrentLiabilities',
        'totalCurrentLiabilities',
        'longTermDebt',
        'deferredRevenueNonCurrent',
        'deferredTaxLiabilitiesNonCurrent',
        'otherNonCurrentLiabilities',
        'totalNonCurrentLiabilities',
        'otherLiabilities',
        'capitalLeaseObligations',
        'totalLiabilities',
        'preferredStock',
        'commonStock',
        'retainedEarnings',
        'accumulatedOtherComprehensiveIncomeLoss',
        'othertotalStockholdersEquity',
        'totalStockholdersEquity',
        'totalEquity',
        'totalLiabilitiesAndStockholdersEquity',
        'minorityInterest',
        'totalLiabilitiesAndTotalEquity',
        'totalInvestments',
        'totalDebt',
        'netDebt',
        'link',
        'finalLink',
        'company_id',
    ];

    public function company() : HasOne {
        return $this->hasOne(Company::class);
    }
}
