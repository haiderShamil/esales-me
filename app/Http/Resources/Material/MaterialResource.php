<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            'name'=> $this->name,
            'code'=> $this->code,
            'quantity'=> $this->quantity,
            'price'=> $this->price,
            'madein'=> $this->madein,
            'dateadd'=> $this->dateadd,
            'extraInfo'=> $this->extraInfo,


        ];
    }
}
