<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function getBiography(){
        return $this->hasOne('app\Models\Api\BiographyModel','user_id','id');
    }
    public function getProfilePhoto(){
        return $this->hasOne('app\Models\Api\ProfilePhotoModel','user_id','id');
    }
    public function getFollowers(){
        return $this->hasMany('app\Models\FollowersModel','user_id','id');
    }
    public function getFollows(){
        return $this->hasMany('app\Models\FollowsModel','user_id','id');
    }
    public function getMessages(){
        return $this->hasMany('app\Models\MessagesModel','user_id','id');
    }
    public function getNotifications(){
        return $this->hasMany('app\Models\NotificationsModel','user_id','id');
    }
    public function getPosts(){
        return $this->hasMany('app\Models\PostsModel','user_id','id');
    }
    public function getUserState(){
        return $this->hasOne('app\Models\UserStateModel','user_id','id');
    }
}
