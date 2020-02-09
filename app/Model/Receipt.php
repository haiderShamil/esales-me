<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Receipt extends Model
{
    //
    use softDeletes;
    protected $fillable = [ 
        'name', 'noreceipt', 'preaccount', 'received', 'postaccount', 'datereceipt'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class); 
    }
   
}
