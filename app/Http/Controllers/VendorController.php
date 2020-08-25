<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use App\Tag;
use App\Taggable;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return VendorResource::collection(Vendor::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:128',
        ],[
            'required'=>':attribute Cannot Empty',
            'max'=>':attribute The name cannot be longer than :max characters'
        ]);
       if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        }else{
            $tag = Tag::all()->random(8);
            $vendor = new Vendor;                      
            $vendor->name = $request->input('name');
            $vendor->save();
            foreach ($tag as $key => $value) {
                $taggable = new Taggable;  
                $taggable->tag_id = $value->id;
                $taggable->taggable_id = $vendor->id;
                $taggable->taggable_type = "App\Vendor";
                $taggable->save();
            };
            return VendorResource::collection(Vendor::where('id',$vendor->id)->get());
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return VendorResource::collection(Vendor::where('id',$request->input('id'))->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
        $vendor = Vendor::find($id);
        $vendor->name = $request->input("name");
        $vendor->save();

        return VendorResource::collection(Vendor::where('id',$id)->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vendor = Vendor::find($id);
        $vendor->delete();
        $taggable = Taggable::where('taggable_id',$id)->delete();

        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>"Success Delete Data"
        ],200);
    }

    public function tags(Request $request){
        $vendor = Taggable::with('tags','vendors')->whereIn('tag_id',$request->input('tag'))->get();
        return response()->json($vendor);
    }
}
