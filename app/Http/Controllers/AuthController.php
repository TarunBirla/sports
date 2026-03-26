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
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password)
        ]);

        return redirect('/login');
    }

    // LOGIN
    public function login(Request $req)
    {
        if(Auth::attempt($req->only('email','password'))){

            $vendor = Vendor::where('email', $req->email)->first();
            if($vendor){
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

        return back()->with('error','Invalid login');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function profile()
    {
        return view('auth.profile');
    }
    
    public function dashboard($categoryId)
    {
        $stats = StatValue::with('field')
            ->where('user_id', auth()->id())
            ->where('category_id', $categoryId)
            ->get();

        return view('user.dashboard', compact('stats'));
    }
}
