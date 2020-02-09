<?php

namespace App\Http\Controllers;
use App\Http\Resources\Material\MaterialResource;
use App\Http\Requests\MaterialRequest;
use App\Model\Material;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return MaterialResource::collection(Material::all());
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
    public function store(MaterialRequest $request)
    {
        //
        $material = new Material;
        $material->name = $request->name;
        $material->code = $request->code;
        $material->quantity = $request->quantity;
        $material->price = $request->price;
        $material->madein = $request->madein;
        $material->dateadd = $request->dateadd;
        $material->extraInfo = $request->extraInfo;
        $material->save();
        return response([
            'data' => new MaterialResource($material)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
         //return $material;
         return new MaterialResource($material);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $request['quantity'] = $material->quantity + $request->quantity; 
        $material->update($request->all());
        return response([
        'data' => new MaterialResource($material)
        ],Response::HTTP_CREATED); 

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
        $material->delete();
        return 'item deleted';
    }
}
