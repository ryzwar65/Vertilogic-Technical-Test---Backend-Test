<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function vendors()
    {
        return $this->morphedByMany('App\Vendor', 'taggable');
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
