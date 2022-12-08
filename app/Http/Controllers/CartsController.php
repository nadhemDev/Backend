<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 public function calcTotal($idu){
    $totalss = 0;
    $cards = Cart::Where('user_id', $idu)->with('product')->get();
        foreach ($cards as $key => $cart) {
            $totalssunit = 0;
            $cards[$key]->product->total = $totalssunit + ($cart->product->price * $cart->quantity);
            $totalss+= $cards[$key]->product->total;
        }
        return $totalss;
 }
 public function AllCart (Request $request){
     $cart = Cart::all();
        return response()->json(
            $cart
             , 201);
              
 }


 public function AddToCart(Request $request)
    {
          
        $user = auth()->guard('api')->user();
        $request->validate([
            
            
            'product_id'=>'required|integer',
            'quantity' => 'integer'
            
            
            
        ]);
      
  if (!isset($request->quantity)){
            
            $qte=1;
        }else{
              $qte=$request->quantity;
        }
        $cart = new Cart([
            

            'user_id' => $user->id,
            'product_id'=>$request->product_id,
            'quantity' =>$qte

            

            
        ]);

       

    
        $cart->save();
        return response()->json(
           $cart
        , 201);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
   public function editCart(Request $request, $id)
    {

            $user = auth()->guard('api')->user();
            $cart = Cart::Where('user_id', $user->id)->with('product')->get();
            $cart = Cart::find($id);
            $cart->quantity = $request->quantity;
            $cart->save();
            $totalss=$this->calcTotal($user->id);
            if ($cart == true) {
            return response()->json([
                'message' => 'Cart update',
                'total' => $totalss
            ]);
        } else {
            return response()->json(['message' => 'Cart not found']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show()
       {
        $total = 0;
        $user = auth()->guard('api')->user();
        $carts = Cart::Where('user_id', $user->id)->with('product')->get();
        
        //echo json_encode($carts);
        foreach ($carts as $key => $cart) {
            $totalunit = 0;
            $carts[$key]->product->total = $totalunit + ($cart->product->price * $cart->quantity);
            $total+= $carts[$key]->product->total;
        } 
        return response()->json(
        [
            'carts' => $carts,
            'total' => $total,
            'path' => url('images/products')."/"
        ]      );
    }
     
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$user = auth()->guard('api')->user();
        //$carts = Cart::Where('user_id', $user->id)->with('product')->get();
        
        //$deleted = Cart::destroy($id);

        $card = Cart::find($id);
        $user = User::find($card->user_id);

        $card->delete();

        $totalss=$this->calcTotal($user->id);

        if ($card == true) {
            return response()->json([
                'message' => 'Cart deleted',
                'total' => $totalss
            ]);
        } else {
            return response()->json(['message' => 'Cart not found']);
        }
    }

}