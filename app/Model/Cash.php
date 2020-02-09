<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Cash extends Model
{
    //
    use softDeletes;
    protected $fillable = [ 
        'name', 'amount', 'currency', 'date',
    ];
}
