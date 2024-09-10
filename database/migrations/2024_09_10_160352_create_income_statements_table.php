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
        Schema::create('income_statements', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
		    $table->string('symbol')->nullable();
		    $table->string('reportedCurrency')->nullable();
		    $table->string('cik')->nullable();
		    $table->string('fillingDate')->nullable();
		    $table->dateTime('acceptedDate')->nullable();
		    $table->string('calendarYear')->nullable();
		    $table->string('period')->nullable();
		    $table->double('revenue')->nullable();
		    $table->double('costOfRevenue')->nullable();
		    $table->double('grossProfit')->nullable();
		    $table->double('grossProfitRatio')->nullable();
		    $table->double('researchAndDevelopmentExpenses')->nullable();
		    $table->double('generalAndAdministrativeExpenses')->nullable();
		    $table->double('sellingAndMarketingExpenses')->nullable();
		    $table->double('sellingGeneralAndAdministrativeExpenses')->nullable();
		    $table->double('otherExpenses')->nullable();
		    $table->double('operatingExpenses')->nullable();
		    $table->double('costAndExpenses')->nullable();
		    $table->double('interestIncome')->nullable();
		    $table->double('interestExpense')->nullable();
		    $table->double('depreciationAndAmortization')->nullable();
		    $table->double('ebitda')->nullable();
		    $table->double('ebitdaratio')->nullable();
		    $table->double('operatingIncome')->nullable();
		    $table->double('operatingIncomeRatio')->nullable();
		    $table->double('totalOtherIncomeExpensesNet')->nullable();
		    $table->double('incomeBeforeTax')->nullable();
		    $table->double('incomeBeforeTaxRatio')->nullable();
		    $table->double('incomeTaxExpense')->nullable();
		    $table->double('netIncome')->nullable();
		    $table->double('netIncomeRatio')->nullable();
		    $table->double('eps')->nullable();
		    $table->double('epsdiluted')->nullable();
		    $table->double('weightedAverageShsOut')->nullable();
		    $table->double('weightedAverageShsOutDil')->nullable();
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
        Schema::dropIfExists('income_statements');
    }
};
