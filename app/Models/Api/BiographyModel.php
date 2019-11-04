<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BiographyModel extends Model
{

    protected $table="biography";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'biography_content',
    ];
}
