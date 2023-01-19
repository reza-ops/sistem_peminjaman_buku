<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Perpustakaan\Petugas;
use App\Models\User;
use Faker\Extension\Helper as ExtensionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

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

    public function registrasi(Request $request){
        event(new \App\Events\SendMessage($request->message));
        return 33;
    }
}
