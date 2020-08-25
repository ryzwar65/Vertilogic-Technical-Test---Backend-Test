<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name'];    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    public function taggables()
    {
        return $this->belongsTo('App\Taggable');
    }
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }
}
