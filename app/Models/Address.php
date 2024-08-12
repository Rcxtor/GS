<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'shipping_address';

    protected $fillable = [
        'user_id','address_line','city','state','country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
