<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Perpustakaan\Petugas;
use App\Models\User;
use Faker\Extension\Helper as ExtensionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $cek_user = User::where('email', $request['email'])->first();
            return redirect('dashboard');

        }
        alert()->html('Email/Password Salah', session('error'), 'error');
        $message = 'Email/Password Salah';
        return redirect(route('login'))->with('error', Helper::parsing_alert($message));
    }
}
