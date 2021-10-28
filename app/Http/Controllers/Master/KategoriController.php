<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    private $route = 'master.kategori.';
    private $title = 'Kategori';
    private $header = 'Kategori';

    public function index(){
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request) {
        $query = Kategori::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {

                /**cek role */
                $aksi = '';
                // if (Auth::user()->can('permission-update')) {
                    $aksi = "<a href=" . URL::to('master/kategori/'.$query->id.'/edit') . " class='btn btn-sm btn-primary btn-edit'>Edit</a>";
                // }

                // if (Auth::user()->can('permission-delete')) {
                    $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/kategori/hapus', ['data_id' =>$query->id]) . "' class='btn btn-danger btn-sm btn-delete'>Delete</a>";
                    // $aksi .= "<form action='{{ route('projects.destroy', $query->id) }}' method='DELETE'>";
                    // $aksi .= "</form>";
                // }
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->escapeColumns([]) //digunakan untuk render html
            ->toJson();
        return $data_table;
    }

    public function create(){
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'create', $data);
    }

    public function store(Request $request){
        $rules = [
            'nama'  => 'required',
            'deskripsi'  => 'required',
        ];

        $alert = [
            'required'  => 'The :attribute is required',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            $insert = [
                'nama' => $request['nama'],
                'deskripsi' => $request['deskripsi'],
            ];

            DB::beginTransaction();
            $query = Kategori::insert($insert);

            if ($query) {
                DB::commit();
                $message = 'Berhasil';
                return redirect(route($this->route.'index'));
            } else {
                DB::rollback();
                $message = 'Gagal';
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function edit($id){
        $kategori = Kategori::where('id', $id)->first();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $kategori,
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Kategori $kategori){
        $rules = [
            'nama'  => 'required',
            'deskripsi'  => 'required',
        ];

        $alert = [
            'required'  => 'The :attribute is required',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            $update = [
                'nama' => $request['nama'],
                'deskripsi' => $request['deskripsi'],
            ];

            DB::beginTransaction();
            $query = $kategori->update($update);

            if ($query) {
                DB::commit();
                $message = 'Berhasil';
                return redirect(route($this->route.'index'));
            } else {
                DB::rollback();
                $message = 'Gagal';
                return redirect()->back();
            }
        }
        return redirect()->back();
    }
    public function destroy($data_id){
        $delete = Kategori::where('id', $data_id)->delete();
        if ($delete) {
            DB::commit();
            $message = 'Sukses';
            $response = [
                'message' => $message,
                'status'   => true,
            ];
            return response()->json($response);
        } else {
            DB::rollback();
            $message = 'Gagal';
            $response = [
                'message' => $message,
                'status'   => false,
            ];
            return response()->json($response);
        }
    }
}
