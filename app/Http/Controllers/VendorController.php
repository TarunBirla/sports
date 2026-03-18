<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    // ✅ Register Form
    public function registerForm()
    {
        return view('vendor.register');
    }

    // ✅ Register Save
    public function register(Request $req)
    {
        Vendor::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'type' => $req->type
        ]);

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
   public function dashboard()
{
    if (!Session::has('vendor_id')) {
        return redirect('/vendor/login');
    }

    $type = Session::get('vendor_type');

    // 🔥 type के हिसाब से dashboard redirect
    if($type == 'training'){
        return redirect('/vendor/training');
    }else{
        return redirect('/vendor/course');
    }
}

    // ✅ Logout
    public function logout()
    {
        Session::forget('vendor_id');
        Session::forget('vendor_type');

        return redirect('/vendor/login');
    }
}