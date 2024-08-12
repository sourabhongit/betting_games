<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DragonTigerLog extends Model
{
    use HasFactory;

    protected $table = 'dragon_tiger_logs';

    protected $fillable = [
        'session_id',
        'status',
        'result',
    ];

    public function Bets()
    {
        return $this->hasMany(DragonTigerBet::class, 'log_id');
    }
}
