<?php

namespace App\Http\Controllers\Master;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Master\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use PHPUnit\TextUI\Help;
use Validator;
use Yajra\DataTables\DataTables;

class PengunjungController extends Controller
{
    private $route = 'master.pengunjung.';
    private $title = 'Pengunjung';
    private $header = 'Pengunjung';


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
        $query = Pengunjung::query();
        $data_table =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('keterangan', function($query){
                if($query->is_boleh_pinjam == '0'){
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
                    if($query->is_boleh_pinjam == '1'){
                        $aksi .= "<a href='javascript:;' data-route='" . URL::to('master/pengunjung/change_status_pengunjung', ['data_id' =>$query->id]) . "' class='btn btn-warning btn-sm btn-change-status-pengunjung'>Ubah Status Pengunjung</a>";
                    }
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
        ];
        return view($this->route.'create', $data);
    }

    public function store(Request $request){
        $rules = [
            'nama'  => 'required',
            'alamat'  => 'required',
            'tanggal_lahir'  => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus di isi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            $request['is_boleh_pinjam'] = 0;
            $request['kode_pengunjung'] = Helper::kode_pengunjung();
            DB::beginTransaction();
            $query = Pengunjung::create($request->all());

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

    public function edit($id){
        Helper::swal();
        $kategori = Pengunjung::where('id', $id)->first();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $kategori,
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Pengunjung $pengunjung){
        $rules = [
            'nama'  => 'required',
            'alamat'  => 'required',
            'tanggal_lahir'  => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus di isi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            DB::beginTransaction();
            $query = $pengunjung->update($request->all());

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
        $delete = Pengunjung::where('id', $data_id)->delete();
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

    public function changeStatusPengunjung($data_id){
        $update = Pengunjung::where('id', $data_id)->update(['is_boleh_pinjam' => '0']);
        if ($update) {
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
