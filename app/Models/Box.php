<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'boxs';

    public function allowedBox()
    {
        //return $this->belongsToMany('App\Group');
    }
}
