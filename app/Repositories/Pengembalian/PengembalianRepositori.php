<?php

namespace App\Repositories\Pengembalian;

use App\Contracts\Pengembalian\PengembalianRepositoriInterface;
use App\Models\Master\Buku;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;

class PengembalianRepositori implements PengembalianRepositoriInterface{
    public function getDataByKode($kode)
    {
        return Peminjaman::where('no_transaksi_peminjaman', $kode)->first();
    }
    public function getDataById($data_id)
    {
        return Peminjaman::where('id', $data_id)->first();
    }
    public function updateTransaksiItems($transakasi_id)
    {
        $update_data_buku = Buku::wherein('id', PeminjamanItems::where('peminjaman_id', $transakasi_id)->pluck('buku_id')->toarray())->update([
            'is_stock' => 0
        ]);
        return $update_data_buku;
    }
    public function updateTransaksi($transakasi)
    {

        $set_data_peminjaman = [
            'is_sudah_kembali' => 0
        ];

        if(Carbon::parse($transakasi->tanggal_kembali) < Carbon::now()->format('Y-m-d')){
            $set_data_peminjaman = [
                'is_terlambat_kembali' => 1
            ];
            $set_data_pengunjung = [
                'is_boleh_pinjam' => 1
            ];

            $update_data_pengunjung = Pengunjung::where('id', $transakasi->pengunjung_id)->update($set_data_pengunjung);
        }

        $update_transakasi = $transakasi->update($set_data_peminjaman);
        return $update_transakasi;
    }
}
