<?php

namespace App\Repositories\Kategori;

use App\Contracts\Kategori\KategoriValidasiInterface;
use Validator;

class ValidasiRepository implements KategoriValidasiInterface{
    public function validasiStore($request)
    {
        $rules = [
            'nama'      => 'required',
            'deskripsi' => 'required',
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
            'nama'      => 'required',
            'deskripsi' => 'required',
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
