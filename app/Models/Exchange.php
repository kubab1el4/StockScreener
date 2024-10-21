<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
    ];

    public function companies() : HasMany {
        return $this->hasMany(Exchange::class);
    }
}
