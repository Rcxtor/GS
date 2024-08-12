<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{   
    use HasFactory;
    protected $table = 'games';

    protected $fillable = [
        'title','slug', 'descrip', 'price','rating','quantity','total_sale',  'platform', 'release','trailer','dev','publisher','cover', 'photo','extra','genre','featured','on_sale','sale_date','sale_per','top_sale','coming_soon',
    ];

    // If you want to cast any attributes to specific types
    protected $casts = [
        'release' => 'date',
        'sale_date' => 'date',
        'price' => 'decimal:2', 
        'rating' => 'decimal:1', 
        'quantity' => 'decimal:0', 
        'total_sale' => 'decimal:0', 
        'sale_per' => 'decimal:1', 
        'images' => 'array',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($game) 
        {
            $game->slug = Str::slug($game->title) . '-' . $game->id;
        });
        static::updating(function ($game) 
        {
            $game->slug = Str::slug($game->title) . '-' . $game->id;
        });
        
    }
    public function images()
    {
        return $this->hasMany(GameImage::class);
    }
    public function details()
    {
        return $this->hasOne(GameDetails::class);
    }
}
