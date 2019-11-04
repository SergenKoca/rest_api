<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    protected $table="posts_v2";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'img_url',
        'tag',
        'post_comment',
    ];

    public function getComment(){
        return $this->hasMany('app\Models\CommentsModel','post_id','id');
    }
}
