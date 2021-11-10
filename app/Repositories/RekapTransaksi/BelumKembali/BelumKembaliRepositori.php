<?php

namespace App\Repositories\RekapTransaksi\BelumKembali;

use App\Contracts\RekapTransaksi\BelumKembali\BelumKembaliRepositoriInterface;
use App\Models\Transaksi\Peminjaman;

class BelumKembaliRepositori implements BelumKembaliRepositoriInterface{
    public function getData($request)
    {
        $query = Peminjaman::getDataRekapBelumKembali($request->input('tanggal_awal'), $request->input('tanggal_akhir'));
        return $query;
    }
}
