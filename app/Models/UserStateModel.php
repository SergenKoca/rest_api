<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStateModel extends Model
{
    protected $table="user_state";
    public $timestamps=true;
    protected $fillable = [
        'user_id',
        'is_online',
        'is_writing',
    ];
}
