<?php

namespace App\Models\Api;

use App\Events\BioEvent;
use Illuminate\Database\Eloquent\Model;

class BiographyModel extends Model
{

    protected $table="biography";
    public $timestamps=true;
    protected $fillable=[
        'user_id',
        'biography_content',
    ];

    protected $dispatchesEvents= [
        'created'=>BioEvent::class
    ];
}
