<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'sumdept'=> $this->sumdept,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'dateadd'=> $this->dateadd,
            'note'=> $this->note

        ];
    }
}
