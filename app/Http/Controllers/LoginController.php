<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('login');
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->only(['email', 'password']);
//         if (Auth::attempt($credentials)) {
//             // Login successful, redirect to dashboard
//             return redirect()->intended(route('dashboard'));
//         } else {
//             // Login failed, redirect back to login page
//             return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
//         }
//     }
// }
