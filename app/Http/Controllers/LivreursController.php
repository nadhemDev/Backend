<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livreur;

class LivreursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $livreur = Livreur::all();
        return response()->json(
             $livreur
           
        , 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $request->validate([
            'nom' => 'required|string',
            'numero' => 'required|integer',
            'adresse'=> 'required|string'
           
        ]);

          $livreur = new Livreur([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'adresse' => $request->adresse
            
        ]);

           $livreur->save();
        return response()->json(
           $livreur
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
          $livreur = Livreur::find($id);
        return response()->json(
            $livreur
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
        $livreur = Livreur::find($id);
        $livreur->nom = $request->nom;
        $livreur->numero = $request->numero;
        $livreur->adresse = $request->adresse; 
        
         $livreur->save();
    return response()->json(
        $livreur
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
          $livreur=Livreur::find($id);
        if($livreur) {
            $msg = "Successfully deleted livreur!";
            $livreur->delete();
        }
        else{
            $msg = "livreur not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);

    }
    
}
