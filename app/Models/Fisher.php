<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;


class Fisher extends Authenticatable
{
    use HasFactory, MustVerifyEmail, Notifiable, HasMergedRelationships;
    

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
        return $this->belongsToMany(Fisher::class, 'net', 'fisher_id', 'friend_id')
            ->wherePivot('blocked', false)
            ->withTimestamps();
    }
 
    public function netFrom()
    {
        return $this->belongsToMany(Fisher::class, 'net', 'friend_id', 'fisher_id')
            ->wherePivot('blocked', false)
            ->withTimestamps();
    }

    public function allNet()
    {
        return $this->mergedRelationWithModel(Fisher::class, 'view_net');
    }

    public function affinities()
    {
        return $this->belongsToMany(Fisher::class, 'affinities', 'fisher_id', 'fisherman_id')
            ->wherePivot('join_date', null)
            ->withTimestamps();
    }
 
    public function affinitiesFrom()
    {
        return $this->belongsToMany(Fisher::class, 'affinities', 'fisherman_id', 'fisher_id')
            ->wherePivot('join_date', null)
            ->withTimestamps();
    }

    public function allAffinities()
    {
        return $this->mergedRelationWithModel(Fisher::class, 'view_affinities');
    }
    # FriendShip
    # https://blog.codecourse.com/setting-up-laravel-friendship-relations
}