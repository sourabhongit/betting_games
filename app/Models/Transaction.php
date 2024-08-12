<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = self::generateTransactionId();
        });
    }

    public static function generateTransactionId()
    {
        // Generate a 15-digit random number
        $transactionId = str_pad(mt_rand(1, 999999999999999), 15, '0', STR_PAD_LEFT);
        return $transactionId;
    }

    protected $fillable = [
        'wallet_id', 'amount', 'type', 'wallet_balance', 'description', 'cr_dr',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
