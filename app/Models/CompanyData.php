<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model {
    use HasFactory;

    protected $fillable = [
        'period',
        'guid',
        'type',
        'value',
        'company_id',
    ];
}
