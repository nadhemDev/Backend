$cards = Cart::Where('user_id', $idu)->with('product')->get();
foreach ($cards as $key => $cart) {
    $cards[$key]->product->total = $total + ($cart->product->price * $cart->quantity);
    $total+= $cards[$key]->product->total;
}