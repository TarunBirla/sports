<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\StatField;
use App\Models\StatValue;
use App\Models\StudentFitness;
use App\Models\StudentAttendance;

use App\Models\Payment;
use App\Models\Category;

class VendorController extends Controller
{



  public function dashboard()
{
    if (!Session::has('vendor_id')) {
        return redirect('/vendor/login');
    }

    $vendorId = Session::get('vendor_id');

    // ✅ COUNTS
    $totalProducts = Product::where('vendor_id', $vendorId)->count();
    $totalCourses = Course::where('vendor_id', $vendorId)->count();

    // ✅ ORDER COUNT
    $productIds = Product::where('vendor_id', $vendorId)->pluck('id');
    $courseIds = Course::where('vendor_id', $vendorId)->pluck('id');

    $totalOrders = OrderItem::where(function ($q) use ($productIds, $courseIds) {
        $q->where(function ($q2) use ($productIds) {
            $q2->where('type', 'training')
               ->whereIn('item_id', $productIds);
        })
        ->orWhere(function ($q2) use ($courseIds) {
            $q2->where('type', 'course')
               ->whereIn('item_id', $courseIds);
        });
    })->count();

    // ✅ EARNINGS
    $totalEarnings = Payment::where('vendor_id', $vendorId)->sum('amount');

    // ✅ MONTHLY ORDERS (🔥 FIX)
    $monthlyOrders = Payment::where('vendor_id', $vendorId)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

    // ✅ MONTHLY EARNINGS (🔥 FIX)
    $monthlyEarnings = Payment::where('vendor_id', $vendorId)
        ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

    // ✅ RECENT TRANSACTIONS
    $recentOrders = Payment::where('vendor_id', $vendorId)
        ->latest()
        ->take(5)
        ->get();

    return view('vendor.dashboard', compact(
        'totalProducts',
        'totalCourses',
        'totalOrders',
        'totalEarnings',
        'monthlyOrders',     // 🔥 IMPORTANT
        'monthlyEarnings',   // 🔥 IMPORTANT
        'recentOrders'
    ));
}

    public function chat()
    {
        $trainerId = session('vendor_id') ?? auth()->id();

        $allusers = User::where('trainer_id', $trainerId)->get();

        return view('vendor.chat', compact('allusers'));
    }

    public function performance()
    {
        $vendorId = session('vendor_id');

        $productsCount = Product::where('vendor_id', $vendorId)->count();
        $coursesCount = Course::where('vendor_id', $vendorId)->count();

        return view('vendor.perfomance', compact('productsCount', 'coursesCount'));
    }
    public function allUsers(Request $request)
    {
        $trainerId = session('vendor_id') ?? auth()->id();

        $users = User::where('trainer_id', $trainerId)->get();

        return view('vendor.userlist', compact('users'));
    }

    // ✅ Register Form
    public function registerForm()
    {
        return view('vendor.register');
    }

    // ✅ Register Save
    public function register(Request $req)
    {

        $vendor = Vendor::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'type' => $req->type,
            'user_id' => null
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'trainer_id' => $vendor->id,
            'password' => bcrypt($req->password)
        ]);

        $vendor->user_id = $user->id;
        $vendor->save();

        return redirect('/vendor/login');
    }

    // ✅ Login Form
    public function loginForm()
    {
        return view('vendor.login');
    }

    // ✅ LOGIN METHOD (YAHI MISSING THA 🔥)
    public function login(Request $req)
    {
        $vendor = Vendor::where('email', $req->email)->first();

        if ($vendor && password_verify($req->password, $vendor->password)) {

            Session::put('vendor_id', $vendor->id);
            Session::put('vendor_type', $vendor->type);

            return redirect('/vendor/dashboard');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    // ✅ Dashboard


    // ✅ Logout
    public function logout()
    {
        Session::forget('vendor_id');
        Session::forget('vendor_type');
        Auth::logout();
        return redirect('/vendor/login');
    }

    public function vendorOrders()
    {
        $vendorId = Session::get('vendor_id');

        $productIds = Product::where('vendor_id', $vendorId)->pluck('id');

        $orders = OrderItem::with(['order.user'])
            ->where('type', 'training')
            ->whereIn('item_id', $productIds)
            ->get();

        return view('vendor.training.orders', compact('orders'));
    }

    public function courseOrders()
    {
        $vendorId = Session::get('vendor_id');

        // vendor ke course ids
        $courseIds = Course::where('vendor_id', $vendorId)->pluck('id');

        // sirf us vendor ke course orders
        $orders = OrderItem::with(['order', 'order.user', 'course'])
            ->where('type', 'course')
            ->whereIn('item_id', $courseIds)
            ->get();


        return view('vendor.course.orders', compact('orders'));
    }

    public function courseOrderDetail($id)
    {
        $vendorId = Session::get('vendor_id');

        $orderItem = OrderItem::with(['order.user', 'order', 'course'])
            ->where('id', $id)
            ->whereHas('course', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
            ->firstOrFail();

        return view('vendor.course.order-detail', compact('orderItem'));
    }


    // Show form
    public function create($categoryId)
    {
        $fields = StatField::where('category_id', $categoryId)->get();

        return view('trainer.stats.create', compact('fields', 'categoryId'));
    }

    // Store data

    public function store(Request $request)
    {
        // 🔹 FITNESS SAVE
        StudentFitness::create([
            'trainer_id' => session('vendor_id'),
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'category_id' => $request->category_id,
            'speed' => $request->speed,
            'stamina' => $request->stamina,
            'strength' => $request->strength,
            'agility' => $request->agility,
            'flexibility' => $request->flexibility,
            'endurance' => $request->endurance,
        ]);

        // 🔹 ATTENDANCE SAVE
        if ($request->attendance) {
            foreach ($request->attendance as $week => $value) {
                StudentAttendance::create([
                    'trainer_id' => session('vendor_id'),
                    'user_id' => $request->user_id,
                    'course_id' => $request->course_id,
                    'week' => $week,
                    'attendance' => $value,
                ]);
            }
        }

        return back()->with('success', 'Saved!');
    }

    public function profile()
    {
        if (!Session::has('vendor_id')) {
            return redirect('/vendor/login');
        }

        $vendorId = Session::get('vendor_id');
        $type = Session::get('vendor_type');

        $vendor = Vendor::find($vendorId);

        if ($type == 'training') {

            // PRODUCTS COUNT
            $vendor->products_count = Product::where('vendor_id', $vendorId)->count();

            // PRODUCT IDS
            $productIds = Product::where('vendor_id', $vendorId)->pluck('id');

            // ORDERS COUNT
            $vendor->orders_count = OrderItem::where('type', 'training')
                ->whereIn('item_id', $productIds)
                ->count();

            // REVENUE
            $vendor->total_revenue = OrderItem::where('type', 'training')
                ->whereIn('item_id', $productIds)
                ->sum('price'); // 👈 ensure price column exists

        } else {

            // COURSES COUNT
            $vendor->products_count = Course::where('vendor_id', $vendorId)->count();

            // COURSE IDS
            $courseIds = Course::where('vendor_id', $vendorId)->pluck('id');

            // ORDERS COUNT
            $vendor->orders_count = OrderItem::where('type', 'course')
                ->whereIn('item_id', $courseIds)
                ->count();

            // REVENUE
            $vendor->total_revenue = OrderItem::where('type', 'course')
                ->whereIn('item_id', $courseIds)
                ->sum('price');
        }

        return view('vendor.profile', compact('vendor'));
    }
}