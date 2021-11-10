<?php

namespace App\Repositories\RekapTransaksi\Berhasil;

use App\Contracts\RekapTransaksi\Berhasil\BerhasilRepositoriInterface;
use App\Models\Transaksi\Peminjaman;

class BerhasilRepositori implements BerhasilRepositoriInterface{
    public function getData($request)
    {
        $data = Peminjaman::getDataRekapBerhasil($request->input('tanggal_awal'), $request->input('tanggal_akhir'));
        return $data;
    }
}
