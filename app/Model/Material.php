<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Material extends Model
{
    //
    use softDeletes;
    

    protected $fillable = [ 
        'name', 'code', 'quantity', 'price', 'madein', 'dateadd', 'extraInfo'
    ];
    
    // protected $guarded = [];
    public function salesm()
    {
        return $this->hasMany(Sale::class); 
    }
    public function state()
    {
        return $this->belongsTo(State::class); 
    }
}
