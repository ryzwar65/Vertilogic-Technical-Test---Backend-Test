<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialRequestOrder extends Model
{
    //
    protected $guarded = [];

    protected $primaryKey = 'id_order';

    public function orders()
    {
        return $this->belongsTo('App\Order');
    }
}
