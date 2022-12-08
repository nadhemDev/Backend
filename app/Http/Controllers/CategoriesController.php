<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Product;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categorie = Categories::all();
        return response()->json(
            $categorie
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
            'name' => 'required|Alpha|unique:categories',
            'type' => 'required|string'
            
        ]);
        
        $categorie = new Categories([
            'name' => $request->name,
            'type' => $request->type
           
        ]);

      
    
        $categorie->save();
        return response()->json(
           $categorie
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
          $categorie = Categories::find($id);
        return response()->json(
            $categorie
        , 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $categories = Categories::find($id);
        $categories->name = $request->name;
        $categories->type = $request->type;
        
            $categories->save();
         return response()->json(
        $categories

    , 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
        $categorie=Categories::find($id);
        if($categorie) {
            $msg = "Successfully deleted product!";
            $categorie->delete();
        }
        else{
            $msg = "Product not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);
    }

    public function category(Request $request){
        //$category = Categories::with('product')->find($request->get('category_id'));

        $products = Product::where("category_id",$request->get('category_id'))->get();
        return response()->json(
            $products
        );
    }

     public function one($id)
    {
    
        $categorie = Categories::find($id);
        return response()->json(
            $categorie
        , 201);

    }

}
