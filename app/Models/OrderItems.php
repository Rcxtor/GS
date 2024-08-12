<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'orderitems'; 

    protected $fillable = [
        'order_id', 'game_id', 'quantity', 'price',
    ];

    protected $casts = [
        'price' => 'decimal:2', 
        'quantity' => 'integer', 
    ];

    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
