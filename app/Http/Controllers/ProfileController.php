<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{
    private $route = 'profile.';
    private $title = 'Profile';
    private $header = 'Profile';


    public function edit($id){
        Helper::swal();
        $kategori = User::where('id', $id)->first();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $kategori,
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, User $user){
        $rules = [
            'name'  => 'required',
            'email' => 'required',
        ];


        $alert = [
            'required'  => ':attribute harus di isi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {
            DB::beginTransaction();
            $set_data_user = [
                'name' => $request['name'],
                'email' => $request['email'],
            ];
            if(!empty($request['password'])){
                $set_data_user['password'] = Hash::make($request['password']);
            }
            $query = User::where('id', Auth::user()->id)->update($set_data_user);

            if ($query) {
                DB::commit();
                $message = 'Berhasil';
                return redirect()->back()->with('success', Helper::parsing_alert($message));
            } else {
                DB::rollback();
                $message = 'Gagal';
                return redirect()->back()->with('error', Helper::parsing_alert($message));
            }
        }
        $message = Helper::parsing_alert($validator->errors()->all());
        return redirect()->back()->with('error', Helper::parsing_alert($message));
    }
}
