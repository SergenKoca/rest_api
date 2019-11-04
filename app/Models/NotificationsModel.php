<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
    protected $table="notifications";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'to_who_id',
        'notifi_content',
    ];
}
