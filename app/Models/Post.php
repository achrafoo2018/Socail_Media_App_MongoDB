<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = "mongodb";

    protected $guarded = [];

    public function user(){

        return $this->belongsTo('App\Models\User', 'created_by.id');
    }

}
