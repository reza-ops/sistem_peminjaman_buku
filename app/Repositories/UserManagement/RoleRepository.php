<?php
namespace App\Repositories\UserManagement;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleRepository {
    public function getDataTable($request)
    {
        $query = Role::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                $aksi = '';
                    // $aksi = "<a href=" . URL::to('master/pengunjung/'.$query->id.'/edit') . " class='btn btn-sm btn-primary btn-edit'>Edit</a>";
                    // $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/pengunjung/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
                    // $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/pengunjung/change_status_pengunjung', ['data_id' =>$query->id]) . "' class='btn btn-warning btn-sm btn-change-status-pengunjung'>Ubah Status Pengunjung</a>";
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->escapeColumns([])
            ->toJson();
        return $data_table;
    }
}
