<?php

namespace App\Repositories\Peminjaman;

use App\Contracts\Peminjaman\PeminjamanValidasiInterface;
use Validator;

class ValidasiPeminjamanRepositori implements PeminjamanValidasiInterface{
    public function validasiPeminjaman($request)
    {
        $rules = [
            'pengunjung'      => 'required',
            'tanggal_pinjam'  => 'required',
            'tanggal_kembali' => 'required',
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
    public function cekStatusBuku($request)
    {
        $data=[
            'status'=>true,
        ];
        if(empty($request)){
            $data=[
                'error'=> 'Belum Memilih Buku',
                'status'=>false,
            ];
            return $data;
        }
        if(count(array_unique($request))<count($request))
        {
            $data=[
                'error'=> 'Buku Tidak Boleh Sama',
                'status'=>false,
            ];
            return $data;
        }
        return $data;
    }
}
