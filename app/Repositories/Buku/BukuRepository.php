<?php

namespace App\Repositories\Buku;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Contracts\Buku\BukuRepositoryInterface;
use App\Helpers\Helper;
use App\Models\Master\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

//use Your Model

/**
 * Class BukuRepository.
 */
class BukuRepository implements BukuRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function getDataTable(Request $request)
    {
        $query = Buku::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('keterangan', function($query){
                return $query->is_stock == '0' ? 'Tersedia' : 'Dipinjam';
            })
            ->addColumn('biaya', function($query){
                return 'Rp, '.number_format($query->biaya_per_hari, 2);
            })
            ->addColumn('aksi', function ($query) {
                $aksi = '';
                    $aksi = "<a href=" . URL::to('master/buku/'.$query->id.'/edit') . " class='btn btn-sm btn-primary btn-edit'>Edit</a>";
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/buku/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
                    $aksi .= "<a target='_blank' href='" . URL::to('master/buku/cetak_barcode', ['data_id' =>$query->id]) . "' class='btn btn-info btn-sm'>Cetak Barcode</a>";
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->escapeColumns([]) //digunakan untuk render html
            ->toJson();
        return $data_table;
    }
    public function store(Request $request)
    {
        $data_kode_buku = [
            'nama' => $request['nama']
        ];
        $create_kode_buku = Helper::kode_buku($data_kode_buku);

        $buku                 = new Buku();
        $buku->kode_buku      = $create_kode_buku;
        $buku->nama           = $request->input('nama');
        $buku->kategori_id    = $request->input('kategori_id');
        $buku->biaya_per_hari = $request->input('biaya_per_hari');
        $buku->is_stock       = 0;
        $buku->save();

        return $buku;
    }
    public function getDataById($data_id)
    {
        $data = Buku::where('id', $data_id)->first();
        return $data;
    }

    public function update(Request $request,$buku)
    {
        $query = $buku->update($request->all());
        return $query;
    }
    public function destroy($data_id)
    {
        $query = Buku::where('id', $data_id)->delete();
        return $query;
    }
}
