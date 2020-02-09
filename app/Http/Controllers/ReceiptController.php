<?php

namespace App\Http\Controllers;
use App\Http\Resources\Receipt\ReceiptResource;
use App\Http\Requests\ReceiptRequest;
use App\Model\Client;

use App\Model\Receipt;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ReceiptResource::collection(Receipt::all());
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
    public function store(ReceiptRequest $request)
    {
        //
        $receipt = new Receipt;
        $receipt->client_id = $request->client_id;
        $id= $request->client_id;
        $client = Client::findorfail($id);
        // $client = Client::findorfail($id)->where('name', '=', $request->name)->get();
        // $users = DB::table('clients')->where('votes', '>', 100)->get();


        $receipt->name = $client->name;
        $receipt->noreceipt = $request->noreceipt;
        $receipt->preaccount = $client->sumdept;
        $receipt->received = $request->received;
        $receipt->postaccount = ($client->sumdept - $request->received);
        $receipt->datereceipt = $request->datereceipt;
        $receipt->save();
        
        
        $client->sumdept=$receipt->postaccount;
        $client->save();

        return response([
            'data' => new ReceiptResource($receipt)
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
        //return $receipt;
        return new ReceiptResource($receipt);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
        
        $client = Client::findorfail( $receipt->client_id);
        $receipt->received = $request->received;
        $receipt->preaccount = $client->sumdept;
        $receipt->postaccount = ($client->sumdept - $request->received);

        $client->sumdept=$receipt->postaccount;

        $client->update();
        $receipt->update($request->all());
        return response([
            'data' => new ReceiptResource($receipt)
        ],Response::HTTP_CREATED); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
        $id= $receipt->client_id;
        $client = Client::findorfail($id);     
        $client->sumdept = $client->sumdept + $receipt->received;
        $client->save();
        $receipt->delete();
    }
}
