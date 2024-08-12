<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DragonTigerBet extends Model
{
    use HasFactory;

    protected $table = 'dragon_tiger_bets';

    protected $fillable = [
        'log_id',
        'user_id',
        'bet_amount',
        'bet_on',
        'result',
        'win_lost'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Log()
    {
        return $this->belongsTo(DragonTigerLog::class, 'log_id');
    }
}
