<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SpecialRequestOrder;
use App\Http\Resources\OrderResource; 
use App\Http\Resources\SpecialRequestResource;   
use App\Order;
class SpecialRequestController extends Controller
{
    //
    public $order;
    public $catatan;
    public $qty;
    public function __construct($order,$catatan,$qty){
        $this->order    = $order;
        $this->catatan  = $catatan;
        $this->qty    = $qty;
    }

    public function specialrequest(){
        $specialrequest = new SpecialRequestOrder;
        $specialrequest->id_order   = $this->order;
        $specialrequest->catatan    = $this->catatan;
        $specialrequest->qty        = $this->qty;
        $specialrequest->save();
        $order = Order::with('tags','vendors')->where('id',$this->order)->first();
        $data = [
            'catatan'   =>$this->catatan,
            'qty'       =>$this->qty,
            'orders'    =>$order,
        ];
        return response()->json($data);
    }
}
