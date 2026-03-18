<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
 public function add($type,$id)
{
    Cart::create([
        'user_id'=>auth()->id(),
        'type'=>$type,
        'item_id'=>$id,
        'qty'=>1
    ]);

    return back();
}

// CART PAGE
public function index()
{
    $cart = Cart::where('user_id',auth()->id())->get();
    return view('cart',compact('cart'));
}
}
