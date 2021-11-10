<?php

namespace App\Repositories\DaftarTransaksi\BelumKembali;

use App\Contracts\DaftarTransaksi\BelumKembali\BelumKembaliRepositoriInterface;
use App\Models\Transaksi\Peminjaman;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class BelumKembaliRepositori implements BelumKembaliRepositoriInterface{
    public function getDataTable($request)
    {
        $query = Peminjaman::getDataTableBelumKembali();
        $data_table =  DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('aksi', function ($query) {
            $aksi = '';
                $aksi = "<a href=" . URL::to('daftar_transaksi/belum_kembali/'.$query->id.'/detail') . " class='btn btn-sm btn-primary btn-edit'>Detail</a>";
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
