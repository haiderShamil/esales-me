<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\State;
use App\Model\Material;
use App\Model\Sale;
use App\Model\Client;
use Illuminate\Support\Facades\DB;
class StateController extends Controller
{
    //
    public function index()
    {

        $count = 0;
        $sale = Sale::get();
        foreach ($sale as $value) {
            $count = $count + $value->total ;
        }
        //  return $count;

        $dept =0;
        $client = Client::get();
        foreach ($client as $cli) {
            $dept = $dept + $cli->sumdept ;
        }
        // return $dept;
        $mate =0;
        $materila = Material::get();
        foreach ($materila as $mat) {
            $mate = $mat->id ;
        }
        //   return $mate;
        return ['مجموع الديون ',$dept,'عدد العملاء',$mate,'مجموع المبيعات',$count];
    }
    public function search()
    {
        $req = 'haider';
        $client = Client::get();
        foreach ($client as $value) {
            if ($req == $value->name) {
                return $req;
            }
            else
            {
                return 'not found';
            }
        }
        //  return $count;
    }
}
