<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'config' => 'array',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(BankDetail::class);
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function gameLogs()
    {
        return $this->belongsToMany(GameLog::class, 'game_log_users');
    }
}
