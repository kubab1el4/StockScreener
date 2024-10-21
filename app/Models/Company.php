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
        'sector',
        'full_time_employees',
        'subindustry',
        'industry',
        'financials_updated',
        'country',
        'description',
    ];

    public function exchange() : HasOne {
        return $this->hasOne(Exchange::class);
    }

    public function fundamental() : HasOne {
        return $this->hasOne(Fundamental::class);
    }

    public function data() : HasMany {
        return $this->hasMany(CompanyData::class);
    }

    public function getFundamentalValue(string $guid, int $limit, string $function, string $type = 'A') {
        return $this->hasMany(CompanyData::class)->where('guid', $guid)->where('type', $type)->limit($limit)->orderByDesc('period')->$function('value');
    }
}
