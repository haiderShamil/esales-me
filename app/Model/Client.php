<?php

namespace App\Model;
use App\Model\Client;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\softDeletes;

class Client extends Model
{
    //
    protected $fillable = [ 
        'name', 'sumdept', 'phne', 'address','dateadd','note'
    ];

    // use softDeletes;

    public function receipts()
    {
        return $this->hasMany(Receipt::class); 
    }
    public function sales()
    {
        return $this->hasMany(Sale::class); 
    }
    public function state()
    {
        return $this->belongsTo(State::class); 
    }
}
