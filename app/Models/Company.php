<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'exchange_id',
        'name',
        'symbol',
    ];

    public function exchange() : HasOne {
        return $this->hasOne(Exchange::class);
    }

    public function balanceStatements() : HasMany {
        return $this->hasMany(BalanceStatement::class);
    }

    public function cashFlowStatements() : HasMany {
        return $this->hasMany(CashFlowStatement::class);
    }

    public function incomeStatements() : HasMany {
        return $this->hasMany(IncomeStatement::class);
    }
}
