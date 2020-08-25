<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'name_customer' => $this->name_customer,
            'qty' => $this->qty,           
            'vendors' => VendorResource::collection($this->vendors),
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
