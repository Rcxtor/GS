<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'code','amount','is_active',
    ];

    protected $casts = [
        'amount' => 'decimal:2', 
        'is_active' => 'boolean',
    ];
}
