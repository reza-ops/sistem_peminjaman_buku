<?php

namespace App\Repositories\DaftarTransaksi\Berhasil;

use App\Contracts\DaftarTransaksi\Berhasil\BerhasilRepositoriInterface;
use App\Models\Transaksi\Peminjaman;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class BerhasilRepositori implements BerhasilRepositoriInterface{
    public function getDataTable($request)
    {
        $query = Peminjaman::getDataTableBerhasil();
        $data_table =  DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('aksi', function ($query) {
            $aksi = '';
                $aksi = "<a href=" . URL::to('daftar_transaksi/berhasil/'.$query->id.'/detail') . " class='btn btn-sm btn-primary btn-edit'>Detail</a>";
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
}
