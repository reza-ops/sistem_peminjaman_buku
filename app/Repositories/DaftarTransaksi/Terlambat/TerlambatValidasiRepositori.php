<?php

namespace App\Repositories\DaftarTransaksi\Terlambat;

use App\Contracts\DaftarTransaksi\Terlambat\TerlambatValidasiInterface;
use Validator;

class TerlambatValidasiRepositori implements TerlambatValidasiInterface{
    public function validasiUpdate($request)
    {
        $rules = [
            'total_biaya'      => 'required',
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
