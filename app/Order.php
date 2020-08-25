<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];

    public function tags(){
        return $this->hasMany('App\Tag', 'id','id_tag');
    }
    public function vendors(){
        return $this->hasMany('App\Vendor', 'id','id_vendor');
    }
    public function specialrequestorders(){
        return $this->hasMany('App\SpecialRequestOrder','id_order','id');
    }
}
