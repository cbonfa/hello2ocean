<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Fisher extends Authenticatable
{
    use HasFactory, MustVerifyEmail, Notifiable;

    protected $guard = "fisher";

    protected $fillable = [
        'name',
        'profile_image',
        'nick',
        'nick_image',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];   

    public function net()
    {
        return $this->belongsToMany(User::class, 'net', 'fisher_id', 'friend_id')
            ->wherePivot('blocked', false)
            ->withTimestamps();
    }
 
    public function netFrom()
    {
        return $this->belongsToMany(User::class, 'net', 'friend_id', 'fisher_id')
            ->wherePivot('blocked', false)
            ->withTimestamps();
    }

    public function affinities()
    {
        return $this->belongsToMany(User::class, 'net', 'fisher_id', 'fisherman_id')
            ->wherePivot('join_date', null)
            ->withTimestamps();
    }
 
    public function affinitiesFrom()
    {
        return $this->belongsToMany(User::class, 'net', 'fisherman_id', 'fisher_id')
        ->wherePivot('join_date', null)
            ->withTimestamps();
    }
}