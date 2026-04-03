<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $req)
    {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'dob' => $req->dob,
            'password' => bcrypt($req->password)
        ]);

        return redirect('/login');
    }

    // LOGIN
    public function login(Request $req)
    {
        if (Auth::attempt($req->only('email', 'password'))) {

            $vendor = Vendor::where('email', $req->email)->first();
            if ($vendor) {
                Session::put('vendor_id', $vendor->id);
                Session::put('vendor_type', $vendor->type);
                $user = User::where('email', $req->email)->first();
                Auth::login($user);
                return redirect('/vendor/dashboard');
            }

            $user = User::where('email', $req->email)->first();
            Auth::login($user);

            return redirect('/');
        }

        return back()->with('error', 'Invalid login');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }




public function profile()
{
    $userId = auth()->id();

    

    // Latest Orders
    $orders = Order::with('items')
                ->where('user_id', $userId)
                ->latest()
                ->take(5)
                ->get();

    // ✅ Total Orders
    $totalOrders = Order::where('user_id', $userId)->count();

    // ✅ Total Earnings (column = total)
    $totalEarnings = Order::where('user_id', $userId)
                        ->sum('total');

    // ❌ status nahi hai to temporary logic:
    $completedOrders = $totalOrders; // ya koi aur logic bana sakte ho

    return view('auth.profile', compact(
        'orders',
        'totalOrders',
        'completedOrders',
        'totalEarnings'
    ));
}

    public function dashboard($categoryId)
    {
        $stats = StatValue::with('field')
            ->where('user_id', auth()->id())
            ->where('category_id', $categoryId)
            ->get();

        return view('user.dashboard', compact('stats'));
    }
    public function updateProfile(Request $req)
    {
        $user = auth()->user();

        $user->update([
            'age' => $req->age,
            'batting' => $req->batting,
            'bowling' => $req->bowling,
            'academy' => $req->academy,

            'total_matches' => $req->total_matches,
            'runs' => $req->runs,
            'wickets' => $req->wickets,
            'strike_rate' => $req->strike_rate,
            'batting_average' => $req->batting_average,
            'high_score' => $req->high_score,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }


    public function updateRank(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rank' => 'required|integer|min:1'
        ]);

        $user = \App\Models\User::findOrFail($request->user_id);

        $user->update([
            'rank' => $request->rank
        ]);

        return back()->with('success', 'Rank updated successfully');
    }

    public function rankings()
    {
        $users = User::whereNotNull('trainer_id')->whereNotNull('rank')->orderBy('rank', 'asc') // or order by rating
                    ->get();

        return view('dashboard.rankings', compact('users'));
    }
}
