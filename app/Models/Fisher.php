<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;
use Illuminate\Support\Carbon;

use function PHPSTORM_META\map;

class Fisher extends Authenticatable
{
    use HasFactory, MustVerifyEmail, Notifiable, HasMergedRelationships;
    

    protected $guard = "fisher";

    //protected $dateFormat = 'd/m/Y';

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'birthdate'
    // ];

    protected $fillable = [
        'name',
        'profile_image',
        'nick',
        'nick_image',
        'email',
        'password',
        'gender',
        'birthdate',
        'language_id',
        'country_id',
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

    public function chat(){
        return $this->hasMany(Chat::class); 
    }

    public function chat_from($receiver){
        $receiver_id = ($receiver instanceof Fisher) ? $receiver->id : $receiver;
        return $this->chat()->where('receiver_id','=', $receiver_id)->orderBy('created_at');
    }

    public function addNet($fisher)
    {

        $fisher_id = ($fisher instanceof Fisher) ? $fisher->id : $fisher;
        if (!Net::where(['fisher_id' => $this->id, 'friend_id' => $fisher_id])->exists()) {
            Net::create(['fisher_id' => $this->id, 'friend_id' => $fisher_id, 'join_date' => Carbon::now()]);
        }

    }

    protected function Birthdate(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->format('d/m/Y'),
            set: fn ($value) =>  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
            
        );
    }

//     protected function Birthdate(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
//        );
//    }

}