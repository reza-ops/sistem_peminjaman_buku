<?php

namespace App\Repositories\Pengembalian;

use App\Contracts\Pengembalian\PengembalianRepositoriInterface;
use App\Models\Master\Buku;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Denda;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanBermasalah;
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
            'is_sudah_kembali' => 0,
            'tanggal_pengembalian' => Carbon::now(),
        ];

        if(Carbon::parse($transakasi->tanggal_kembali) < Carbon::now()->format('Y-m-d')){
            $set_data_peminjaman = [
                'is_terlambat_kembali' => 1,
                'is_sudah_kembali' => 0,
                'tanggal_pengembalian' => Carbon::now(),
            ];
            $set_data_pengunjung = [
                'is_boleh_pinjam' => 0
            ];
            $update_data_pengunjung = Pengunjung::where('id', $transakasi->pengunjung_id)->update($set_data_pengunjung);

            $set_data_denda = [
                'peminjaman_id' => $transakasi->id,
                'total_terlambat' => Carbon::parse($transakasi->tanggal_kembali)->diffInDays(Carbon::now())
            ];

            $create_denda = Denda::create($set_data_denda);
        }

        $update_transakasi = $transakasi->update($set_data_peminjaman);
        return $update_transakasi;
    }
    public function sendDenda($request)
    {
        $set_data_peminjaman_bermasalah = [
            'buku_id'      => $request['id_buku'],
            'transaksi_id' => $request['id_transaksi'],
            'denda'        => $request['denda'],
            'keterangan'   => $request['keterangan'],
        ];

        return PeminjamanBermasalah::create($set_data_peminjaman_bermasalah);
    }
    public function getBiayaLain($transaksi_id)
    {
        $query = PeminjamanBermasalah::where('transaksi_id', $transaksi_id['id_transaksi'])
        ->join('buku','buku.id','peminjaman_bermasalah.buku_id')
        ->select('buku.nama as nama_buku', 'peminjaman_bermasalah.denda','peminjaman_bermasalah.keterangan','peminjaman_bermasalah.buku_id')
        ->get();

        $data = [];
        foreach($query as $key => $value){
            $data[$key] = [
                'nama_buku' => $value->nama_buku,
                'keterangan' => $value->keterangan,
                'denda' => number_format($value->denda,2),
                'total' => $value->denda,
                'buku_id' => $value->buku_id,
            ];
        }

        return $data;
    }
}
