<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
}
