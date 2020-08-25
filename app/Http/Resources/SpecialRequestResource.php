<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'catatan'=>$this->catatan,
            'qty_catatan'=>$this->qty,
            'orders'=>OrderResource::collection($this->orders),
        ];
    }
}
