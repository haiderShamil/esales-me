<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Sale extends Model
{
    //
    use softDeletes;
    
    protected $fillable =
    [
        'clientname', 'materialname', 'code', 'price', 'amount', 'no'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class); 
    }
    public function material()
    {
        return $this->belongsTo(Material::class); 
    }
    public function state()
    {
        return $this->belongsTo(State::class); 
    }
}
