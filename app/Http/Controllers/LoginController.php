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
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email',
            'password'              => 'required|same:password_confirmation|min:6',
            'password_confirmation' => 'required',
        ];

        $alert = [
            'required' => ':attribute harus di isi',
            'min'      => ':attribute password minimal 6',
            'unique'   => ':attribute sudah digunakan',
            'same'     => ':attribute password harus sama',
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {
            $request['password'] = Hash::make($request['password']);
            $query = User::create($request->all());
            if ($query) {
                $credentials = [
                    'email' => $request['email'],
                    'password' => $request['password_confirmation'],
                ];
                if (Auth::attempt($credentials)) {
                    return redirect('dashboard');

                }else{
                    $message = Helper::parsing_alert($validator->errors()->all());
                    alert()->html($message, session('error'), 'error');

                    return redirect()->back()->with('error', Helper::parsing_alert($message));
                }
            } else {
                $message = 'Gagal';
                return redirect()->back()->with('error', Helper::parsing_alert($message));
            }
        }
        $message = Helper::parsing_alert($validator->errors()->all());
        alert()->html($message, session('error'), 'error');

        return redirect()->back()->with('error', Helper::parsing_alert($message));
    }
}
