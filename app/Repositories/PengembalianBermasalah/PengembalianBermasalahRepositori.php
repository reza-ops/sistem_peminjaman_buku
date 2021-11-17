<?php

namespace App\Repositories\PengembalianBermasalah;

use App\Contracts\PengembalianBermasalah\PengembalianBermasalahInterface;
use App\Models\Transaksi\Peminjaman;

class PengembalianBermasalahRepositori implements PengembalianBermasalahInterface{
    public function getDataBykode($request)
    {
        return Peminjaman::where('no_transaksi_peminjaman', $request)->first();
    }
}
