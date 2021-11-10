<?php

namespace App\Repositories\RekapTransaksi\Terlambat;

use App\Contracts\RekapTransaksi\Terlambat\TerlambatRepositoriInterface;
use App\Models\Transaksi\Peminjaman;

class TerlambatRepositori implements TerlambatRepositoriInterface{
    public function getData($request)
    {
        $query = Peminjaman::getDataRekapTerlambat($request->input('tanggal_awal'), $request->input('tanggal_akhir'));
        return $query;
    }
}
