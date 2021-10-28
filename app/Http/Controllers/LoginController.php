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
        // dd(Auth::attempt($credentials), $credentials);
        if (Auth::attempt($credentials)) {
            $cek_user = User::where('email', $request['email'])->first();
            // if success login
            // dd($cek_user);
            return redirect('dashboard');
            // if(!empty(Petugas::where('user_id', $cek_user->id)->first())){
            //     return redirect('dashboard');
            // }
            // Auth::logout();
            // $message = 'Akun yang Anda Gunakan Salah';
            // return redirect(route('login'))->with('error', Helper::parsing_alert($message));

            //return redirect()->intended('/details');
        }
        // if failed login
        // if (session('error')) {
        //     alert()->html('', session('error'), 'error');
        // }
        $message = 'Email/Password Salah';
        return redirect(route('login'))->with('error', Helper::parsing_alert($message));
    }
}
