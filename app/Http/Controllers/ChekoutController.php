<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chekout;

class ChekoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|integer',
            'codepostal' => 'required|integer',
            'phone'=> 'required|integer',
            'email'=>'required|string',
            'modedelivraison' => 'required|string'
            'cart_id' =>'required|intger',
            'livreur_id'=>'required|integer'
        ]);

         $chekout = new Chekout([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'codepostal' => $request->codepostal,
            'phone' => $request->phone,
            'email'=> $request->email,
            'modedelivraison'=>$request->modedelivraison,
            'cart_id' =>$request->cart_id,
            'livreur_id'=>$request->livreur_id
        ]);

         $chekout->save();
        return response()->json(
           $chekout
        , 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $chekout = Chekout::find($id);
        return response()->json(
            $chekout
        , 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $chekout = Product::find($id);
        $chekout->firstname = $request->firstname;
        $chekout->lastname = $request->lastname;
        $chekout->codepostal = $request->codepostal;
        $chekout->phone = $request->phone;
        $chekout->email = $request->email;
        $chekout->modedelivraison = $request->modedelivraison;
        $chekout->image = $request ->image;

             $chekout->save();
    return response()->json(
        $chekout
    , 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
