<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    //
    protected $guarded =[];
    protected $primaryKey = 'tag_id';
    public function tags()
    {
        return $this->hasMany('App\Tag','id','tag_id');
    }
    public function vendors()
    {
        return $this->hasMany('App\Vendor','id','taggable_id');
    }
}
