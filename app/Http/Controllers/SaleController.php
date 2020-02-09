<?php

namespace App\Http\Controllers;
use App\Http\Resources\Sale\SaleResource;
use App\Http\Requests\SaleRequest;
use App\Model\Sale;
use App\Model\Client;
use App\Model\Material;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return SaleResource::collection(Sale::all());
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
    public function store(SaleRequest $request)
    {
        //
        $sale = new Sale;
        $sale->client_id = $request->client_id;
        $sale->material_id = $request->material_id;

        $id_c= $sale->client_id;
        $client = Client::findorfail($id_c);

        $id_m= $sale->material_id;
        $material = Material::findorfail($id_m);

        $sale->clientname = $client->name;
        $sale->materialname = $material->name;
        $sale->code = $material->code;
        $sale->price = $request->price;
        $sale->amount = $request->amount;
        $material->quantity = ($material->quantity -  $sale->amount);
        $sale->total = ($request->price * $request->amount);
        $client->sumdept = $client->sumdept +  $sale->total;
        $sale->no = $request->no;
        $sale->save();
        $client->update();
        $material->update();
        return response([
            'data' => new SaleResource($sale)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
         //return $sale;
         return new SaleResource($sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //

        $client = Client::findorfail( $sale->client_id);
        $material = Material::findorfail( $sale->material_id);

        $sale->price = $request->price;
        $material->quantity=$material->quantity-($request->amount -  $sale->amount);
        $sale->amount = $request->amount;
        $t=$sale->total;
        $sale->total = ($request->amount * $request->price);
        $client->sumdept=$client->sumdept + ($sale->total - $t);
      
        $sale->update($request->all());
        $client->update();
        $material->update();
        return response([
            'data' => new SaleResource($sale)
        ],Response::HTTP_CREATED); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
        $id_c= $sale->client_id;
        $client = Client::findorfail($id_c);

        $id_m= $sale->material_id;
        $material = Material::findorfail($id_m);

        $client->sumdept = $client->sumdept - $sale->total;
        $material->quantity = $material->quantity - $sale->amount;

        $client->save();
        $material->save();
        $sale->delete();
    }
}
