<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index']);

// USER AUTH
Route::get('/login',function(){
    return view('auth.login');
});

Route::get('/register',function(){
    return view('auth.register');
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

// PROFILE
Route::get('/profile',[AuthController::class,'profile']);

// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

Route::get('/vendor/register',[VendorController::class,'registerForm']);
Route::post('/vendor/register',[VendorController::class,'register']);
Route::get('/vendor/login',[VendorController::class,'loginForm']);
Route::post('/vendor/login',[VendorController::class,'login']);
Route::get('/vendor/logout',[VendorController::class,'logout']);
Route::get('/vendor/dashboard',[VendorController::class,'dashboard']);

Route::get('/vendor/training',[ProductController::class,'index']);
Route::get('/vendor/training/create',[ProductController::class,'create']);
Route::post('/vendor/training/store',[ProductController::class,'store']);
Route::get('/vendor/training/edit/{id}',[ProductController::class,'edit']);
Route::post('/vendor/training/update/{id}',[ProductController::class,'update']);
Route::get('/vendor/training/delete/{id}',[ProductController::class,'delete']);
Route::get('/vendor/course',[CourseController::class,'index']);
Route::get('/vendor/course/create',[CourseController::class,'create']);
Route::post('/vendor/course/store',[CourseController::class,'store']);
Route::get('/vendor/course/edit/{id}',[CourseController::class,'edit']);
Route::post('/vendor/course/update/{id}',[CourseController::class,'update']);
Route::get('/vendor/course/delete/{id}',[CourseController::class,'delete']);

Route::get('/add-training',[ProductController::class,'create']);
Route::post('/add-training',[ProductController::class,'store']);

Route::get('/add-course',[CourseController::class,'create']);
Route::post('/add-course',[CourseController::class,'store']);
Route::get('/cart',[CartController::class,'index']);
Route::get('/cart/add/{type}/{id}',[CartController::class,'add']);

Route::get('/place-order',[OrderController::class,'placeOrder']);
Route::get('/my-orders',[OrderController::class,'myOrders']);

Route::get('/admin',[AdminController::class,'dashboard']);
