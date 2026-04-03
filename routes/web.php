<?php

use App\Http\Controllers\Admin\BulkEmailController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\SmtpAccountController;
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
use App\Http\Controllers\StudentStatsController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MatchController;

// Route::get('/matches', function () {
//     return view('dashboard.matches');
// })->name('matches');
Route::get('/matches', [MatchController::class, 'upcomingMatches'])->name('matches');

// Route::get('/feedback', function () {
//     return view('dashboard.feedback');
// })->name('feedback');

Route::get('/feedback', [FeedbackController::class, 'feedbacks'])->name('feedback');


// Route::get('/rankings', function () {
//     return view('dashboard.rankings');
// })->name('rankings');

Route::get('/rankings', [AuthController::class, 'rankings'])->name('rankings');


// Route::get('/orders', function () {
//     return view('dashboard.orders');
// })->name('orders');
Route::get('/orders', [OrderController::class, 'myOrders'])->name('orders');


Route::get('/profiles', function () {
    $matches = auth()->user()->matches()->where('status', 'complete')->get();
    return view('dashboard.profile', compact('matches'));
})->name('profiles');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments');

Route::get('/broadcast', [BroadcastController::class, 'userindex'])->name('broadcast');

Route::get('/shop', function () {
    return view('dashboard.shop');
})->name('shop');





Route::get('/dashboard', [StudentStatsController::class, 'dashboard'])->name('dashboard');


Route::post('/send-email', [ChatController::class, 'sendEmail']);

// USER CHAT
Route::get('/user/chat', [ChatController::class, 'userChat'])->name('user.chat');
Route::get('/vendor/chat', [ChatController::class, 'vendorChat']);

Route::get('/chat/messages/{id}', [ChatController::class, 'getMessages']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);



Route::get('/', [HomeController::class, 'index']);

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
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Show stats entry form
Route::get(
    '/stats/create/{categoryId}/{userId?}/{courseId?}',
    [TrainerStatsController::class, 'create']
)
    ->name('trainer.stats.create');

Route::get('/student-stats/{userId}', [StudentStatsController::class, 'index']);
Route::post('/student-stats/{userId}', [StudentStatsController::class, 'save']);
Route::get('/student-stats/list/{userId}', [StudentStatsController::class, 'list'])->name('student.stats.list');

// routes/web.php

Route::get('/student-stats/edit/{userId}', [StudentStatsController::class, 'edit'])->name('student.stats.edit');
Route::put('/student-stats/update/{userId}', [StudentStatsController::class, 'update']);

// Store stats
Route::post(
    '/stats/store',
    [TrainerStatsController::class, 'store']
)
    ->name('trainer.stats.store');

// List all stats
Route::get(
    '/stats',
    [TrainerStatsController::class, 'index']
)
    ->name('trainer.stats.index');

// Get stats (JSON)
Route::get(
    '/stats/api/{userId}/{categoryId}',
    [TrainerStatsController::class, 'getStats']
)
    ->name('trainer.stats.api');

// Delete stat
Route::delete(
    '/stats/{id}',
    [TrainerStatsController::class, 'destroy']
)
    ->name('trainer.stats.destroy');

// Export stats
Route::get(
    '/stats/export',
    [TrainerStatsController::class, 'export']
)
    ->name('trainer.stats.export');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// PROFILE
Route::get('/profile', [AuthController::class, 'profile']);

// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

Route::get('/vendor/performance', [VendorController::class, 'performance'])->name('vendor.performance');
Route::get('/vendor/allusers', [VendorController::class, 'allUsers'])->name('vendor.allusers');

Route::get('/vendor/userlist', [PaymentController::class, 'userList'])->name('vendor.users');
// Route::get('/vendor/dashboard', [PaymentController::class, 'vendorDashboard'])
//     ->name('vendor.dashboard');

// Route::get('/vendor/bordcast', function () {
//     return view('vendor.bordcast');
// })->name('bordcast');




Route::prefix('vendor')->group(function () {
    Route::get('/matches', [MatchController::class, 'index'])->name('vendor.matches.index');
    Route::get('/matches/create', [MatchController::class, 'create'])->name('vendor.matches.create');
    Route::post('/matches/store', [MatchController::class, 'store'])->name('vendor.matches.store');
    Route::get('/matches/{id}/edit', [MatchController::class, 'edit'])->name('vendor.matches.edit');
    Route::put('/matches/{id}', [MatchController::class, 'update'])->name('vendor.matches.update');
    Route::post('/matches/{id}/update-status', [MatchController::class, 'updateStatus'])
        ->name('matches.updateStatus');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/update-rank', [AuthController::class, 'updateRank'])->name('update-rank');
});

// store message
Route::post('/vendor/bordcast', [BroadcastController::class, 'store']);

// get messages
Route::get('/vendor/bordcast', [BroadcastController::class, 'index']);

// Route::get('/vendor/coach', function () {
//     return view('vendor.coach');
// })->name('coach');

Route::get('/vendor/coaches', [CoachController::class, 'index'])->name('vendor.coaches');
Route::post('/vendor/coaches/store', [CoachController::class, 'store']);
Route::post('/vendor/coaches/update/{id}', [CoachController::class, 'update']);
Route::get('/vendor/coaches/{id}', [CoachController::class, 'show']);

Route::get('/vendor/transactions', [PaymentController::class, 'indexVendor']);


Route::get('/vendor/profile', [VendorController::class, 'profile']);
Route::get('/vendor/register', [VendorController::class, 'registerForm']);
Route::post('/vendor/register', [VendorController::class, 'register']);
Route::get('/vendor/login', [VendorController::class, 'loginForm']);
Route::post('/vendor/login', [VendorController::class, 'login']);
Route::get('/vendor/logout', [VendorController::class, 'logout']);
Route::get('/vendor/dashboard', [VendorController::class, 'dashboard']);

Route::get('/vendor/training', [ProductController::class, 'index']);
Route::get('/vendor/training/create', [ProductController::class, 'create']);
Route::post('/vendor/training/store', [ProductController::class, 'store']);
Route::get('/vendor/training/edit/{id}', [ProductController::class, 'edit']);
Route::put('/vendor/training/update/{id}', [ProductController::class, 'update']);
Route::delete('/vendor/training/delete/{id}', [ProductController::class, 'delete']);
Route::get('/vendor/training/order', [VendorController::class, 'vendorOrders']);
Route::get('/vendor/course', [CourseController::class, 'index']);
Route::get('/vendor/course/create', [CourseController::class, 'create']);
Route::post('/vendor/course/store', [CourseController::class, 'store']);
Route::get('/vendor/course/edit/{id}', [CourseController::class, 'edit']);
Route::put('/vendor/course/update/{id}', [CourseController::class, 'update']);
Route::delete('/vendor/course/delete/{id}', [CourseController::class, 'delete']);
Route::get('/vendor/course/order', [VendorController::class, 'courseOrders']);
Route::get('/vendor/course-orders/{id}', [VendorController::class, 'courseOrderDetail'])
    ->name('vendor.course.order.detail');


// Trainer
Route::get('/trainer/stats/{category}', [VendorController::class, 'create']);
// Route::post('/trainer/stats/store', [VendorController::class, 'store'])->name('trainer.stats.store');
Route::post(
    '/trainer/stats/store',
    [VendorController::class, 'store']
)
    ->name('vendor.stats.store'); // ✅ change name


// User
Route::get('/dashboard/{category}', [AuthController::class, 'dashboard'])->name('user.dashboard');

Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/add-training', [ProductController::class, 'create']);
Route::post('/add-training', [ProductController::class, 'store']);

Route::get('/add-course', [CourseController::class, 'create']);
Route::post('/add-course', [CourseController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/add/{type}/{id}', [CartController::class, 'add']);

Route::get('/place-order', [OrderController::class, 'placeOrder']);

Route::get('/vendor/category', [CategoryController::class, 'index']);

// Route::get('/vendor/chat', [VendorController::class, 'chat'])->name('chat');

Route::get('/vendor/category/create', [CategoryController::class, 'create']);
Route::post('/vendor/category/store', [CategoryController::class, 'store']);
Route::get('/vendor/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/vendor/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/vendor/category/delete/{id}', [CategoryController::class, 'delete']);
Route::get('/admin', [AdminController::class, 'dashboard']);



// ADMIN
Route::get('/hash', function () {
    return bcrypt('admin123');
});
Route::get('/admin/login', [AdminController::class, 'loginForm']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/vendors', [AdminController::class, 'vendors']);
Route::get('/admin/orders', [AdminController::class, 'orders']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::get('/admin/banner', [BannerController::class, 'index']);
Route::get('/admin/banner/create', [BannerController::class, 'create']);
Route::post('/admin/banner/store', [BannerController::class, 'store']);
Route::get('/admin/banner/edit/{id}', [BannerController::class, 'edit']);
Route::post('/admin/banner/update/{id}', [BannerController::class, 'update']);
Route::get('/admin/banner/delete/{id}', [BannerController::class, 'delete']);


Route::get('/admin/payments', function () {
    return view('admin.payment'); // make sure file name matches
})->name('admin.payment');

Route::prefix('admin')->group(function () {

    // Route::get('/dashboard',[BulkEmailController::class, 'index'])->name('admin.dashboard');
    Route::get('/test-mail', function () {
        Mail::to('infoharry99@gmail.com')
            ->send(new \App\Mail\BulkMail());
        return 'Mail sent';
    });
    Route::post(
        '/bulk-emails/test-mail',
        [App\Http\Controllers\Admin\BulkEmailController::class, 'sendTestMail']
    )->name('admin.bulk-emails.test-mail');


    Route::post(
        '/bulk-emails/{id}/toggle-block',
        [BulkEmailController::class, 'toggleBlock']
    )->name('admin.bulk-emails.toggle-block');

    Route::get('/email-template', [EmailTemplateController::class, 'edit'])
        ->name('admin.email-template.edit');

    Route::post('/email-template', [EmailTemplateController::class, 'update'])
        ->name('admin.email-template.update');

    Route::post(
        '/bulk-emails/reset-all',
        [BulkEmailController::class, 'resetAll']
    )->name('admin.bulk-emails.reset-all');

    Route::post(
        '/bulk-emails/{id}/reset',
        [BulkEmailController::class, 'resetStatus']
    )->name('admin.bulk-emails.reset');

    // Bulk Email Management
    Route::get('bulk-emails', [BulkEmailController::class, 'indexs'])
        ->name('admin.bulk-emails.index');
    Route::get('bulk-emails', [BulkEmailController::class, 'index'])
        ->name('admin.bulk-emails.index');

    Route::post('/bulk-emails', [BulkEmailController::class, 'store'])
        ->name('admin.bulk-emails.store');

    // SMTP Management
    Route::get('n/smtp', [SmtpAccountController::class, 'index'])
        ->name('admin.smtp.index');

    Route::post('/smtp', [SmtpAccountController::class, 'store'])
        ->name('admin.smtp.store');



});