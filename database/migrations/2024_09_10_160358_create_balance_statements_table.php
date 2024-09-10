<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balance_statements', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('symbol')->nullable();
            $table->string('reportedCurrency')->nullable();
            $table->string('cik')->nullable();
            $table->string('fillingDate')->nullable();
            $table->dateTime('acceptedDate')->nullable();
            $table->string('calendarYear')->nullable();
            $table->string('period')->nullable();
            $table->double('cashAndCashEquivalents')->nullable();
            $table->double('shortTermInvestments')->nullable();
            $table->double('cashAndShortTermInvestments')->nullable();
            $table->double('netReceivables')->nullable();
            $table->double('inventory')->nullable();
            $table->double('otherCurrentAssets')->nullable();
            $table->double('totalCurrentAssets')->nullable();
            $table->double('propertyPlantEquipmentNet')->nullable();
            $table->double('goodwill')->nullable();
            $table->double('intangibleAssets')->nullable();
            $table->double('goodwillAndIntangibleAssets')->nullable();
            $table->double('longTermInvestments')->nullable();
            $table->double('taxAssets')->nullable();
            $table->double('otherNonCurrentAssets')->nullable();
            $table->double('totalNonCurrentAssets')->nullable();
            $table->double('otherAssets')->nullable();
            $table->double('totalAssets')->nullable();
            $table->double('accountPayables')->nullable();
            $table->double('shortTermDebt')->nullable();
            $table->double('taxPayables')->nullable();
            $table->double('deferredRevenue')->nullable();
            $table->double('otherCurrentLiabilities')->nullable();
            $table->double('totalCurrentLiabilities')->nullable();
            $table->double('longTermDebt')->nullable();
            $table->double('deferredRevenueNonCurrent')->nullable();
            $table->double('deferredTaxLiabilitiesNonCurrent')->nullable();
            $table->double('otherNonCurrentLiabilities')->nullable();
            $table->double('totalNonCurrentLiabilities')->nullable();
            $table->double('otherLiabilities')->nullable();
            $table->double('capitalLeaseObligations')->nullable();
            $table->double('totalLiabilities')->nullable();
            $table->double('preferredStock')->nullable();
            $table->double('commonStock')->nullable();
            $table->double('retainedEarnings')->nullable();
            $table->double('accumulatedOtherComprehensiveIncomeLoss')->nullable();
            $table->double('othertotalStockholdersEquity')->nullable();
            $table->double('totalStockholdersEquity')->nullable();
            $table->double('totalEquity')->nullable();
            $table->double('totalLiabilitiesAndStockholdersEquity')->nullable();
            $table->double('minorityInterest')->nullable();
            $table->double('totalLiabilitiesAndTotalEquity')->nullable();
            $table->double('totalInvestments')->nullable();
            $table->double('totalDebt')->nullable();
            $table->double('netDebt')->nullable();
            $table->string('link')->nullable();
            $table->string('finalLink')->nullable();
            $table->foreignId('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_statements');
    }
};
