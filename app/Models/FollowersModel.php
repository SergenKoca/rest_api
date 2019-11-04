<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowersModel extends Model
{
    protected $table="followers";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'follower_id',
    ];
}
