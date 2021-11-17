<?php

namespace App\Repositories\Pengembalian;

use App\Contracts\Pengembalian\ValidasiPengembalianInterface;
use Validator;

class PengembalianValidasiRepositori implements ValidasiPengembalianInterface{
    public function validasi_send_denda($request)
    {
        $rules = [
            'denda'      => 'required',
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
