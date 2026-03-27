<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Course;
use App\Models\Performance;
use App\Models\StudentFitness;
use App\Models\AttendanceRecord;
use App\Models\StudentAttendance;
use App\Models\StatCategory;
use App\Models\StatValue;

class OrderController extends Controller
{
  

    public function placeOrder()
    {
        $cart = Cart::where('user_id', auth()->id())->get();

        $total = 0;

        foreach ($cart as $c) {

            if ($c->type == 'training') {
                $item = Product::find($c->item_id);
            } else {
                $item = Course::find($c->item_id);
            }

            if (!$item) continue;

            // SALE PRICE LOGIC
            $price = $item->sale_price ?? $item->price;

            $total += $price * $c->qty;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total
        ]);

        foreach ($cart as $c) {

            if ($c->type == 'training') {
                $item = Product::find($c->item_id);
            } else {
                $item = Course::find($c->item_id);
            }

            if (!$item) continue;

            $price = $item->sale_price ?? $item->price;

            OrderItem::create([
                'order_id' => $order->id,
                'type' => $c->type,
                'item_id' => $c->item_id,
                'price' => $price,
                'qty' => $c->qty
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect('/my-orders');
    }
    public function myOrders()
    {
        $orders = Order::with('items')->where('user_id',auth()->id())->get();
        
        return view('orders',compact('orders'));
    }
    public function orderDetail($id)
    {
        $order = Order::where('user_id', auth()->id())
                    ->with('items')
                    ->findOrFail($id);
          
        
        return view('order-detail', compact('order'));
    }

    public function startCourse($orderId)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('items')
            ->findOrFail($orderId);

        $courseItem = $order->items->where('type', 'course')->first();

        if (!$courseItem) {
            return redirect('/my-orders')->with('error', 'No course found');
        }

        $courseId = $courseItem->item_id;
        $course = Course::findOrFail($courseId);
        // dd($course);

        // 🔥 MAP COURSE → CATEGORY
        $categoryMap = [
            8 => 5,
            9 => 6,
            10 => 3, // cricket
            11 => 4, // football
        ];

        $categoryId = $categoryMap[$course->category_id] ?? 3;

        // ✅ GET CATEGORY + FIELDS
        $category = StatCategory::with('fields')->findOrFail($categoryId);

        $fields = $category->fields;

        // ✅ GET VALUES
        $values = StatValue::where('user_id', auth()->id())
            ->where('category_id', $categoryId)
            ->pluck('value', 'field_id'); // key => field_id

        $fitness = StudentFitness::where('user_id', auth()->id())
            ->where('course_id', $courseId)
            ->first();
        
        $fitnessData = $fitness ? [
            $fitness->speed,
            $fitness->stamina,
            $fitness->strength,
            $fitness->agility,
            $fitness->flexibility,
            $fitness->endurance
        ] : [0,0,0,0,0,0];

        // ATTENDANCE
        $attendance = AttendanceRecord::where('user_id', auth()->id())
            // ->where('course_id', $courseId)
            ->orderBy('week')
            ->get();
        $attendanceLabels = [];
        $attendanceData = [];

        foreach ($attendance as $a) {
            $attendanceLabels[] = $a->week;
            $attendanceData[] = $a->attendance;
        }

        return view('course-start', compact(
            'course',
            'category',
            'fields',
            'values',
            'fitnessData',
            'attendance',
            'fitness',
            'attendanceLabels',
            'attendanceData'
        ));
    }

    // public function startCourse($orderId)
    // {
    //     $order = Order::where('user_id', auth()->id())
    //         ->with('items')
    //         ->findOrFail($orderId);

    //     // course item nikaalo
    //     $courseItem = $order->items->where('type', 'course')->first();

    //     if (!$courseItem) {
    //         return redirect('/my-orders')->with('error', 'No course found');
    //     }

    //     $courseId = $courseItem->item_id;

    //     $course = Course::find($courseId);

    //     if (!$course) {
    //         return redirect('/my-orders')->with('error', 'Course not found');
    //     }

    //     // ✅ PERFORMANCE
    //     $performance = Performance::where('user_id', auth()->id())
    //         ->where('course_id', $courseId)
    //         ->first();

    //     // ✅ FITNESS
    //     $fitness = StudentFitness::where('user_id', auth()->id())
    //         ->where('course_id', $courseId)
    //         ->first();

    //     // ✅ ATTENDANCE (W1–W8)
    //     $attendance = StudentAttendance::where('user_id', auth()->id())
    //         ->where('course_id', $courseId)
    //         ->orderBy('week')
    //         ->get();

    //     $runs = $performance ? [$performance->runs] : [];
    //     $strikeRate = $performance ? [$performance->strick_rate] : [];

    //     $wickets = $performance ? [$performance->wickets] : [];
    //     $economy = $performance ? [$performance->ecconomy] : [];

    //     $fitnessData = $fitness ? [
    //         $fitness->speed,
    //         $fitness->stamina,
    //         $fitness->strength,
    //         $fitness->agility,
    //         $fitness->flexibility,
    //         $fitness->endurance
    //     ] : [0,0,0,0,0,0];

    //     $attendanceLabels = [];
    //     $attendanceData = [];

    //     foreach ($attendance as $a) {
    //         $attendanceLabels[] = $a->week;
    //         $attendanceData[] = $a->attendance; // ⚠️ column name
    //     }

    //     return view('course-start', compact(
    //         'course',
    //         'performance',
    //         'fitness',
    //         'attendance',
    //         'runs',
    //         'strikeRate',
    //         'wickets',
    //         'economy',
    //         'fitnessData',
    //         'attendanceLabels',
    //         'attendanceData'
    //     ));
    // }
}
