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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_id');
            $table->string('symbol')->nullable();
            $table->string('name')->nullable();
            $table->text('sector')->nullable();
            $table->integer('full_time_employees')->nullable();
            $table->text('subindustry')->nullable();
            $table->text('industry')->nullable();
            $table->date('financials_updated')->nullable();
            $table->text('country')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
