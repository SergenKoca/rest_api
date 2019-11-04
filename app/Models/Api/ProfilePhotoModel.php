<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ProfilePhotoModel extends Model
{
    protected $table="profile_photo";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'img_url'
    ];
}
