<?php
namespace App\Repositories\Kategori;

use App\Contracts\Kategori\KategoriRepositoryInterface;
use App\Helpers\Helper;
use App\Models\Master\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;
use Validator;

class KategoriRepository implements KategoriRepositoryInterface
{
    public function getDataTable(Request $request)
    {
        $query = Kategori::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                $aksi = '';
                    $aksi = "<a href=" . URL::to('master/kategori/'.$query->id.'/edit') . " class='btn btn-sm btn-primary btn-edit'>Edit</a>";
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/kategori/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->escapeColumns([]) //digunakan untuk render html
            ->toJson();
        return $data_table;
    }
    public function store($request)
    {
        $kategori                 = new Kategori();
        $kategori->nama           = $request->input('nama');
        $kategori->deskripsi    = $request->input('deskripsi');
        $kategori->save();

        return $kategori;
    }

    public function getDataById($id)
    {
        return Kategori::where('id',$id)->first();
    }

    public function update($request, $kategori)
    {
        $query = $kategori->update($request->all());
        return $query;
    }

    public function destroy($data_id)
    {
        $query = Kategori::where('id', $data_id)->delete();
        return $query;
    }
}
