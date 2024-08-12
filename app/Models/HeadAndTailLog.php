<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadAndTailLog extends Model
{
    use HasFactory;

    protected $table = 'head_and_tail_logs';

    protected $fillable = [
        'session_id',
        'status',
        'result',
    ];

    public function Bets()
    {
        return $this->hasMany(HeadAndTailBet::class, 'log_id');
    }
}
