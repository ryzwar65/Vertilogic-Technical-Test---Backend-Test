<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Vendor;
use App\Tag;
use App\Taggable;
use App\Order;
use DB;
use App\Http\Controllers\SpecialRequestController as SpecialRequest;
class OrderController extends Controller
{
    //
    public function listdishes(Request $request){
        $vendor = $request->vendor[0];
        $dish = $request->dish[0];
        $getdata = Taggable::with('tags','vendors')->where('tag_id',$dish)->where('taggable_id',$vendor)->first();        
        return response()->json([
            'status'=>true,
            'code'=>200,
            'name_restaurant'=>$getdata->vendors[0]->name,
            'dishes_restaurant'=>$getdata->tags[0]->name,
        ]);
    }

    public function order(Request $request){
        $vendor = $request->vendor[0];
        $dish = $request->dish[0];        

        $order = new Order;
        $order->name_customer = $request->input('name_customer');
        $order->qty = $request->input('qty');
        $order->id_vendor = $vendor;
        $order->id_tag = $dish;        
        $order->save();
        
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>'Success Saved Data'
        ]); 
    }

    public function specialorder(Request $request){
        $catatan    = $request->input('catatan');
        $qty        = $request->input('special_qty');
        $order    = $request->input('order');
        $specialrequest     = new SpecialRequest($order,$catatan,$qty);
        return $specialrequest->specialrequest();
    }

    public function listorder(){
        $order = Order::with('tags','vendors','specialrequestorders')->get();
        return response()->json($order);
    }

}
