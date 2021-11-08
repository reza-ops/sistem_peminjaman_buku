<?php

namespace App\Repositories\Buku;

use App\Contracts\Buku\BukuValidasiInterface;
use Validator;

class ValidasiBukuRepository implements BukuValidasiInterface{
    public function validasiStore($request)
    {
        $rules = [
            'nama'           => 'required',
            'biaya_per_hari' => 'required',
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
            'nama'           => 'required',
            'biaya_per_hari' => 'required',
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
