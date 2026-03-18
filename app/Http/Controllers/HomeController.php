<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Course;


class HomeController extends Controller
{
    public function index()
{
    $products = Product::all();
    $courses = Course::all();

    return view('home', compact('products','courses'));
}
}
