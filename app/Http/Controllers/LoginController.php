<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->route('admin.home');
        } else {
            Session::flash('error', 'Email atau password salah.');
            
            return redirect('/login');
        }
    }

    public function actionLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
