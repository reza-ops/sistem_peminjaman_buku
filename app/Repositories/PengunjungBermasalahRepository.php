<?php

namespace App\Repositories;

use App\Models\Master\Pengunjung;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class PengunjungBermasalahRepository
{
    public function getDataTable()
    {
        $query = Pengunjung::where('is_boleh_pinjam', 0);

        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                $aksi = '';
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('pengunjung_bermasalah/update', ['data_id' =>$query->id]) . "' class='btn btn-warning btn-sm btn-update-status-pengunjung'>Ubah Status</a>";
                return $aksi;
            })
            ->addColumn('keterangan', function(){
                $span = '<span class="badge badge-pill badge-danger fz-11">Tidak Boleh Pinjam</span>';
                return $span;
            })
            ->rawColumns(['aksi', 'keterangan'])
            ->escapeColumns([]) //digunakan untuk render html
            ->toJson();
        return $data_table;
    }

    public function update($data_id){
        $pengunjung = Pengunjung::find($data_id);
        $pengunjung->is_boleh_pinjam = 1;
        $pengunjung->save();

        return $pengunjung;
    }

    public function getData(){
        $query = Pengunjung::where('is_boleh_pinjam', 0)
        ->get();

        return $query;

    }
}
