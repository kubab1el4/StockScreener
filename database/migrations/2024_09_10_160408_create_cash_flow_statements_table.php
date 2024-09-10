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
        Schema::create('cash_flow_statements', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('symbol')->nullable();
            $table->string('reportedCurrency')->nullable();
            $table->string('cik')->nullable();
            $table->string('fillingDate')->nullable();
            $table->dateTime('acceptedDate')->nullable();
            $table->string('calendarYear')->nullable();
            $table->string('period')->nullable();
            $table->double('netIncome')->nullable();
            $table->double('depreciationAndAmortization')->nullable();
            $table->double('deferredIncomeTax')->nullable();
            $table->double('stockBasedCompensation')->nullable();
            $table->double('changeInWorkingCapital')->nullable();
            $table->double('accountsReceivables')->nullable();
            $table->double('inventory')->nullable();
            $table->double('accountsPayables')->nullable();
            $table->double('otherWorkingCapital')->nullable();
            $table->double('otherNonCashItems')->nullable();
            $table->double('netCashProvidedByOperatingActivities')->nullable();
            $table->double('investmentsInPropertyPlantAndEquipment')->nullable();
            $table->double('acquisitionsNet')->nullable();
            $table->double('purchasesOfInvestments')->nullable();
            $table->double('salesMaturitiesOfInvestments')->nullable();
            $table->double('otherInvestingActivites')->nullable();
            $table->double('netCashUsedForInvestingActivites')->nullable();
            $table->double('debtRepayment')->nullable();
            $table->double('commonStockIssued')->nullable();
            $table->double('commonStockRepurchased')->nullable();
            $table->double('dividendsPaid')->nullable();
            $table->double('otherFinancingActivites')->nullable();
            $table->double('netCashUsedProvidedByFinancingActivities')->nullable();
            $table->double('effectOfForexChangesOnCash')->nullable();
            $table->double('netChangeInCash')->nullable();
            $table->double('cashAtEndOfPeriod')->nullable();
            $table->double('cashAtBeginningOfPeriod')->nullable();
            $table->double('operatingCashFlow')->nullable();
            $table->double('capitalExpenditure')->nullable();
            $table->double('freeCashFlow')->nullable();
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
        Schema::dropIfExists('cash_flow_statements');
    }
};
