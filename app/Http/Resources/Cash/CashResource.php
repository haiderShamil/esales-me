<?php

namespace App\Http\Resources\Cash;

use Illuminate\Http\Resources\Json\JsonResource;

class CashResource extends JsonResource
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
            'amount'=> $this->amount,
            'currency'=> $this->currency,
            'date'=> $this->date,
            
        ];
    }
}
