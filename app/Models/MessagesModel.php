<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
    protected $table="messages";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'to_who_id',
        'message_content',
    ];
}
