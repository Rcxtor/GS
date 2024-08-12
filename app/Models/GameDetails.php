<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDetails extends Model
{
    use HasFactory;

    protected $table = 'game_details'; 

    protected $fillable = [
        'game_id', 'min_os','min_cpu','min_ram','min_gpu','min_storage','req_os','req_cpu','req_ram','req_gpu','req_storage',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
