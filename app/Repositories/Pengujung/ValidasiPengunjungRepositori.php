<?php

namespace App\Repositories\Pengujung;

use App\Contracts\Pengunjung\PengunjungValidasiInterface;
use Validator;

class ValidasiPengunjungRepositori implements PengunjungValidasiInterface{
    public function validasiStore($request){
        $rules = [
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {
            $data = [
                'status' => true,
            ];
        }else {
            $data = [
                'status' => false,
                'error' => $validator->errors()->all()
            ];
        }

        return $data;
    }

    public function validasiUpdate($request)
    {
        $rules = [
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {
            $data = [
                'status' => true,
            ];
        }else {
            $data = [
                'status' => false,
                'error' => $validator->errors()->all()
            ];
        }

        return $data;
    }
}
