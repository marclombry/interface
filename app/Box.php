<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'boxs';

    protected $fillables = ['title','bgcolor','href','category_id','box_id'];

    public function allowedBox()
    {
        //return $this->belongsToMany('App\Group');
    }
}
