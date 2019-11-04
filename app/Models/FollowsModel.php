<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowsModel extends Model
{
    protected $table="follows";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'follow_id',
    ];
}
