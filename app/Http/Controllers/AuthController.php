<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        $timestamp = strtotime(now());
        $month = date('n', $timestamp);
        return view('auth.login', [
            'title' => 'SIMPUS | Login'
        ]);
    }

    public function authenticate(Request $request) {
        if($request->username == null) {
            return back()->with('loginError', 'Username tidak boleh kosong!');
        }

        if($request->password == null) {
            return back()->with('loginError', 'Password tidak boleh kosong!');
        }

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('toast_success', 'Login Berhasil<br>Selamat Datang '.ucfirst(auth()->user()->username));
        }

        return back()->with('loginError', 'Login Gagal, Username atau Password salah!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
