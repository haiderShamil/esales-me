<?php

namespace App\Http\Controllers;
use App\Http\Resources\Cash\CashResource;
use App\Http\Requests\CashRequest;
use App\Model\Cash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return CashResource::collection(Cash::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRequest $request)
    {
        //
        $cash = new Cash;
        $cash->name = $request->name;
        $cash->amount = $request->amount;
        $cash->currency = $request->currency;
        $cash->date = $request->date;
        $cash->save();
        return response([
            'data' => new CashResource($cash)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
         //return $cash;
         return new CashResource($cash);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cash $cash)
    {
        //
        $cash->update($request->all());
        return response([
            'data' => new CashResource($cash)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash)
    {
        //
        $cash->delete();
    }
}
