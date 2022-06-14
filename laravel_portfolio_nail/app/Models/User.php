<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 관리자
    const STATE_MANAGER = 1;
    // 일반유저
    const STATE_NORMAL = 0;

    public function cartItems()
    {
        return $this->belongsToMany(
            Item::class,
            'carts',
        )->withPivot(['id', 'quantity']);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function getIsAuthorityManagerAttribute()
    {
        return $this->authority === self::STATE_MANAGER;
    }
}
