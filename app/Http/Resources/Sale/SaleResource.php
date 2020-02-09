<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'clientname'=> $this->clientname,
            'materialname'=> $this->materialname,
            'code'=> $this->code,
            'price'=> $this->price,
            'amount'=> $this->amount,
            'total'=>($this->price * $this->amount),
            'no'=> $this->no,
            
        ];
    }
}
