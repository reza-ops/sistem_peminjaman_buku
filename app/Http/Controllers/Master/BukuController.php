<?php

namespace App\Http\Controllers\Master;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Master\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use PHPUnit\TextUI\Help;
use Validator;
use Yajra\DataTables\DataTables;
use PDF;

class BukuController extends Controller
{
    private $route = 'master.buku.';
    private $title = 'Buku';
    private $header = 'Buku';


    public function index(){
        Helper::swal();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request) {
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

    public function create(){
        Helper::swal();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'kategori' => Kategori::get(),
        ];
        return view($this->route.'create', $data);
    }

    public function store(Request $request){
        $rules = [
            'nama'  => 'required',
            'biaya_per_hari'  => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus di isi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            $data_kode_buku = [
                'nama' => $request['nama']
            ];
            $create_kode_buku = Helper::kode_buku($data_kode_buku);
            $request['kode_buku'] = $create_kode_buku;
            $request['is_stock'] = 0;
            DB::beginTransaction();
            $query = Buku::create($request->all());

            if ($query) {
                DB::commit();
                $message = 'Berhasil';
                return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
            } else {
                DB::rollback();
                $message = 'Gagal';
                return redirect()->with('error', Helper::parsing_alert($message));
            }
        }
        $message = Helper::parsing_alert($validator->errors()->all());
        return redirect()->back()->with('error', Helper::parsing_alert($message));
    }

    public function edit($id){
        Helper::swal();
        $kategori = Buku::where('id', $id)->first();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $kategori,
            'kategori' => Kategori::get(),
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Buku $buku){
        $rules = [
            'nama'  => 'required',
            'biaya_per_hari'  => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus di isi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            DB::beginTransaction();
            $query = $buku->update($request->all());

            if ($query) {
                DB::commit();
                $message = 'Berhasil';
                return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
            } else {
                DB::rollback();
                $message = 'Gagal';
                return redirect()->back()->with('error', Helper::parsing_alert($message));
            }
        }
        $message = Helper::parsing_alert($validator->errors()->all());
        return redirect()->back()->with('error', Helper::parsing_alert($message));
    }
    public function destroy($data_id){
        $delete = Buku::where('id', $data_id)->delete();
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

    public function cetakBarcode($data_id){
        $cek_data = Buku::where('id', $data_id)->first();

        if(!empty($cek_data)){
            $pdf = PDF::loadview($this->route.'komponen.cetak_barcode',['buku'=>$cek_data]);
            return $pdf->stream();
        }else{
            $message = 'Data Tidak Ditemukan';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
}
