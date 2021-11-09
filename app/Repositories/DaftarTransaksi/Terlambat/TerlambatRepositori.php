<?php

namespace App\Repositories\DaftarTransaksi\Terlambat;

use App\Contracts\DaftarTransaksi\Terlambat\TerlambatRepositoriInterface;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Denda;
use App\Models\Transaksi\Peminjaman;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class TerlambatRepositori implements TerlambatRepositoriInterface{
    public function getDataTable($request)
    {
        $query = Peminjaman::getDataTableTerlambat();
        $data_table =  DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('aksi', function ($query) {
            $aksi = '';
                $aksi = "<a href=" . URL::to('daftar_transaksi/terlambat/'.$query->id.'/detail') . " class='btn btn-sm btn-primary btn-edit'>Detail</a>";
            //     $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/kategori/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
            return $aksi;
        })
        ->rawColumns(['aksi'])
        ->escapeColumns([]) //digunakan untuk render html
        ->toJson();
        return $data_table;
    }
    public function getDataById($data_id)
    {
        return Peminjaman::where('id', $data_id)->first();
    }
    public function updateDendaTerlambat($denda, $request)
    {
        $get_data_denda = Denda::where('id', $request->input('denda_id'))->first();
        $update_transaksi = $get_data_denda->update($request->all());

        if($get_data_denda->is_sudah_bayar_denda == '0'){
            $data_pengunjung = [
                'is_boleh_pinjam' => 0
            ];
            $update_pengunjung = Pengunjung::where('id', Peminjaman::where('id', $get_data_denda->peminjaman_id)->first()->pengunjung_id)->update($data_pengunjung);
        }

        return $update_transaksi;
    }
}
