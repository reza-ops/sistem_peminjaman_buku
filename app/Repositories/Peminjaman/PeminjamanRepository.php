<?php

namespace App\Repositories\Peminjaman;

use App\Contracts\Peminjaman\PeminjamanRepositoryInterface;
use App\Helpers\Helper;
use App\Models\Master\Buku;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;

class PeminjamanRepository implements PeminjamanRepositoryInterface{
    public function store($request)
    {
        $peminjaman                          = new Peminjaman();
        $peminjaman->no_transaksi_peminjaman = Helper::kode_transaksi(['pengunjung_id' => $request->input('pengunjung')]);
        $peminjaman->pengunjung_id           = $request->input('pengunjung');
        $peminjaman->is_sudah_kembali        = 1;
        $peminjaman->is_terlambat_kembali        = 0;
        $peminjaman->is_sudah_bayar          = $request->input('sudah_bayar');
        $peminjaman->tanggal_pinjam          = $request->input('tanggal_pinjam');
        $peminjaman->tanggal_kembali         = $request->input('tanggal_kembali');
        $peminjaman->total_harga             = Carbon::parse( $request->input('tanggal_pinjam'))->diffInDays(Carbon::parse( $request->input('tanggal_kembali'))) * Buku::whereIn('id', $request->input('buku_id'))->sum('biaya_per_hari') ;
        $peminjaman->save();

        return $peminjaman;
    }

    public function createPeminjamanItems($request, $peminjaman)
    {
        foreach($request->input('buku_id') as $key => $value){

            $create_peminjaman_item[$key] = PeminjamanItems::create([
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => $value,
            ]);
        }

        return $create_peminjaman_item;
    }
    public function updateStatusBuku($request)
    {
        foreach($request->input('buku_id') as $key => $value){

            $d_stock_buku = [
                'is_stock' => 1,
            ];

            $update_status_buku[$key] = Buku::where('id', $value)->update($d_stock_buku);
        }

        return $update_status_buku;
    }
    public function getDataById($data_id)
    {
        return Peminjaman::where('id', $data_id)->first();
    }
}
