<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
 public function index()
{
    $products = Product::where('vendor_id', Session::get('vendor_id'))->get();
    return view('vendor.training.index', compact('products'));
}

// CREATE PAGE
public function create()
{
    return view('vendor.training.create');
}

// STORE
public function store(Request $req)
{
    Product::create([
        'title'=>$req->title,
        'price'=>$req->price,
        'description'=>$req->description,
        'vendor_id'=>Session::get('vendor_id')
    ]);

    return redirect('/vendor/training');
}

// EDIT PAGE
public function edit($id)
{
    $product = Product::find($id);
    return view('vendor.training.edit', compact('product'));
}

// UPDATE
public function update(Request $req, $id)
{
    Product::where('id',$id)->update([
        'title'=>$req->title,
        'price'=>$req->price,
        'description'=>$req->description
    ]);

    return redirect('/vendor/training');
}

// DELETE
public function delete($id)
{
    Product::find($id)->delete();
    return back();
}
}
