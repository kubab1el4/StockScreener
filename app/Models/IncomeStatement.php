<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IncomeStatement extends Model
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
        'revenue',
        'costOfRevenue',
        'grossProfit',
        'grossProfitRatio',
        'researchAndDevelopmentExpenses',
        'generalAndAdministrativeExpenses',
        'sellingAndMarketingExpenses',
        'sellingGeneralAndAdministrativeExpenses',
        'otherExpenses',
        'operatingExpenses',
        'costAndExpenses',
        'interestIncome',
        'interestExpense',
        'depreciationAndAmortization',
        'ebitda',
        'ebitdaratio',
        'operatingIncome',
        'operatingIncomeRatio',
        'totalOtherIncomeExpensesNet',
        'incomeBeforeTax',
        'incomeBeforeTaxRatio',
        'incomeTaxExpense',
        'netIncome',
        'netIncomeRatio',
        'eps',
        'epsdiluted',
        'weightedAverageShsOut',
        'weightedAverageShsOutDil',
        'link',
        'finalLink',
        'company_id',
    ];

    public function company() : HasOne {
        return $this->hasOne(Company::class);
    }
}
