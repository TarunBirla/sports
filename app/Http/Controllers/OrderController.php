<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderController extends Controller
{
  

public function placeOrder()
{
    $cart = Cart::where('user_id',auth()->id())->get();

    $total = 0;

    foreach($cart as $c){
        $total += 100;
    }

    $order = Order::create([
        'user_id'=>auth()->id(),
        'total'=>$total
    ]);

    foreach($cart as $c){
        OrderItem::create([
            'order_id'=>$order->id,
            'type'=>$c->type,
            'item_id'=>$c->item_id,
            'price'=>100,
            'qty'=>$c->qty
        ]);
    }

    Cart::where('user_id',auth()->id())->delete();

    return redirect('/my-orders');
}
public function myOrders()
{
    $orders = Order::where('user_id',auth()->id())->get();
    return view('orders',compact('orders'));
}
}
