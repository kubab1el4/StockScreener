<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fundamental extends Model {
    use HasFactory;

    protected $fillable = [
        'value',
        'company_id'
    ];

    protected $casts = [
        'value' => 'collection',
    ];

    public function company() : HasOne {
        return $this->hasOne(Company::class);
    }
}
