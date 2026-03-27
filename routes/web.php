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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TrainerStatsController;


    Route::get('/',[HomeController::class,'index']);
    Route::get('/platform/{id}', [HomeController::class, 'index']);

    Route::get('/all-products', [HomeController::class, 'allProducts']);
    Route::get('/all-courses', [HomeController::class, 'allCourses']);
    // PRODUCT DETAIL
    Route::get('/product/{id}', [HomeController::class, 'productDetail']);

    // COURSE DETAIL
    Route::get('/course/{id}', [HomeController::class, 'courseDetail']);
    Route::get('/orders/{id}', [OrderController::class, 'orderDetail']);
    Route::get('/course-start/{orderId}', [OrderController::class, 'startCourse']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);

    // USER AUTH
    Route::get('/login',function(){
        return view('auth.login');
    });

    Route::get('/welcome',function(){
        return view('welcome');
    });

    Route::get('/register',function(){
        return view('auth.register');
    });

    // Show stats entry form
    Route::get('/stats/create/{categoryId}/{userId?}/{courseId?}', 
        [TrainerStatsController::class, 'create'])
        ->name('trainer.stats.create');

    // Store stats
    Route::post('/stats/store', 
        [TrainerStatsController::class, 'store'])
        ->name('trainer.stats.store');

    // List all stats
    Route::get('/stats', 
        [TrainerStatsController::class, 'index'])
        ->name('trainer.stats.index');

    // Get stats (JSON)
    Route::get('/stats/api/{userId}/{categoryId}', 
        [TrainerStatsController::class, 'getStats'])
        ->name('trainer.stats.api');

    // Delete stat
    Route::delete('/stats/{id}', 
        [TrainerStatsController::class, 'destroy'])
        ->name('trainer.stats.destroy');

    // Export stats
    Route::get('/stats/export', 
        [TrainerStatsController::class, 'export'])
        ->name('trainer.stats.export');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

// PROFILE
Route::get('/profile',[AuthController::class,'profile']);

// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

Route::get('/vendor/profile', [VendorController::class, 'profile']);
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
Route::put('/vendor/training/update/{id}', [ProductController::class,'update']);
Route::delete('/vendor/training/delete/{id}', [ProductController::class,'delete']);
Route::get('/vendor/training/order', [VendorController::class, 'vendorOrders']);
Route::get('/vendor/course',[CourseController::class,'index']);
Route::get('/vendor/course/create',[CourseController::class,'create']);
Route::post('/vendor/course/store',[CourseController::class,'store']);
Route::get('/vendor/course/edit/{id}',[CourseController::class,'edit']);
Route::put('/vendor/course/update/{id}',[CourseController::class,'update']);
Route::delete('/vendor/course/delete/{id}',[CourseController::class,'delete']);
Route::get('/vendor/course/order', [VendorController::class, 'courseOrders']);
Route::get('/vendor/course-orders/{id}', [VendorController::class, 'courseOrderDetail'])
    ->name('vendor.course.order.detail');


    // Trainer
Route::get('/trainer/stats/{category}', [VendorController::class, 'create']);
// Route::post('/trainer/stats/store', [VendorController::class, 'store'])->name('trainer.stats.store');
Route::post('/trainer/stats/store', 
    [VendorController::class, 'store'])
    ->name('vendor.stats.store'); // ✅ change name


// User
Route::get('/dashboard/{category}', [AuthController::class, 'dashboard'])->name('user.dashboard');

Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/add-training',[ProductController::class,'create']);
Route::post('/add-training',[ProductController::class,'store']);

Route::get('/add-course',[CourseController::class,'create']);
Route::post('/add-course',[CourseController::class,'store']);
Route::get('/cart',[CartController::class,'index']);
Route::get('/cart/add/{type}/{id}',[CartController::class,'add']);

Route::get('/place-order',[OrderController::class,'placeOrder']);
Route::get('/my-orders',[OrderController::class,'myOrders']);

Route::get('/vendor/category', [CategoryController::class, 'index']);
Route::get('/vendor/category/create', [CategoryController::class, 'create']);
Route::post('/vendor/category/store', [CategoryController::class, 'store']);
Route::get('/vendor/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/vendor/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/vendor/category/delete/{id}', [CategoryController::class, 'delete']);
Route::get('/admin',[AdminController::class,'dashboard']);



// ADMIN
Route::get('/hash', function () {
    return bcrypt('admin123');
});
Route::get('/admin/login', [AdminController::class,'loginForm']);
Route::post('/admin/login', [AdminController::class,'login']);
Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
Route::get('/admin/users', [AdminController::class,'users']);
Route::get('/admin/vendors', [AdminController::class,'vendors']);
Route::get('/admin/orders', [AdminController::class,'orders']);
Route::get('/admin/logout', [AdminController::class,'logout']);
Route::get('/admin/banner', [BannerController::class,'index']);
Route::get('/admin/banner/create', [BannerController::class,'create']);
Route::post('/admin/banner/store', [BannerController::class,'store']);
Route::get('/admin/banner/edit/{id}', [BannerController::class,'edit']);
Route::post('/admin/banner/update/{id}', [BannerController::class,'update']);
Route::get('/admin/banner/delete/{id}', [BannerController::class,'delete']);