<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\Cart;
use Auth;
use DB;




class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$product = new Product();
        //$product->name = "nadhem";
        //$product->quantity = 12;
        //$product->price = 100;
        //$product->save();

        $product = Product::all();
        return response()->json([
            'product' => $product,
            'path' => url('images/products')."/"
        ]
           
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
            'productName' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'desc'=> 'required|string',
            'statut'=>'required|integer',
            'image' => 'required'
        ]);
        
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/products'; 
        $request->image->move($path,$file_name);

        $product = new Product([
            'productName' => $request->productName,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'desc'=> $request->desc,
            'statut'=>$request->statut,
            'image' =>$file_name
        ]);

      
       

      
        $product->save();
        return response()->json(
           $product
        , 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function Search(Request $request)
    {
        $request->validate([
            'productName' => 'required'
        ]);
        
        $productName =  $request->get('productName');

        $Search_product = Product::where('productName', 'Like', "%".$productName."%" )->get();
        return response()->json(

            $Search_product
        , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $product = Product::find($id);
        return response()->json([
            'product' => $product,
            'path' => url('images/products')."/"
        ]
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

        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/products'; 
        $request->image->move($path,$file_name);
         
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->desc = $request->desc;
        $product->statut = $request->statut;
        $product->image = $file_name;

    
    
    $product->save();
    return response()->json(
        $product
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
        $product=Product::find($id);
        if($product) {
            $msg = "Successfully deleted product!";
            $product->delete();
        }
        else{
            $msg = "Product not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);
    }





}