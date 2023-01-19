<?php

namespace App\Repositories\Pengujung;

use App\Contracts\Pengunjung\PengunjungRepositoryInterface;
use App\Helpers\Helper;
use App\Models\Master\Pengunjung;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class PengunjungRepository implements PengunjungRepositoryInterface{
    public function getDataTable($request)
    {
        $query = Pengunjung::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('keterangan', function($query){
                if($query->is_boleh_pinjam == '1'){
                    $span = '<span class="badge badge-pill badge-success fz-11">Boleh Pinjam</span>';
                }else {
                    $span = '<span class="badge badge-pill badge-danger fz-11">Tidak Boleh Pinjam</span>';
                }
                return $span;
            })
            ->addColumn('biaya', function($query){
                return 'Rp, '.number_format($query->biaya_per_hari, 2);
            })
            ->addColumn('aksi', function ($query) {
                $aksi = '';
                    $aksi = "<a href=" . URL::to('master/pengunjung/'.$query->id.'/edit') . " class='btn btn-sm btn-primary btn-edit'>Edit</a>";
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/pengunjung/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/pengunjung/change_status_pengunjung', ['data_id' =>$query->id]) . "' class='btn btn-warning btn-sm btn-change-status-pengunjung'>Ubah Status Pengunjung</a>";
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->escapeColumns([]) //digunakan untuk render html
            ->toJson();
        return $data_table;
    }

    public function store($request)
    {
        $pengunjung = new Pengunjung();
        $pengunjung->is_boleh_pinjam = 0;
        $pengunjung->kode_pengunjung = Helper::kode_pengunjung();
        $pengunjung->nama            = $request->input('nama');
        $pengunjung->alamat          = $request->input('alamat');
        $pengunjung->tanggal_lahir   = $request->input('tanggal_lahir');
        $pengunjung->no_telepon      = $request->input('no_telepon');
        $pengunjung->save();

        return $pengunjung;
    }

    public function getDataById($data_id)
    {
        return Pengunjung::where('id', $data_id)->first();
    }

    public function update($request, $pengunjung)
    {
        $query = $pengunjung->update($request->all());
        return $query;
    }

    public function destroy($data_id)
    {
        $query = Pengunjung::where('id', $data_id)->delete();
        return $query;
    }

    public function changeStatus($data_id)
    {
        $query = Pengunjung::where('id', $data_id)->first();
        if($query->is_boleh_pinjam == '1'){
            $query->is_boleh_pinjam = 0;
        }else {
            $query->is_boleh_pinjam = 1;
        }
        $query->save();
        return $query;
    }
}
