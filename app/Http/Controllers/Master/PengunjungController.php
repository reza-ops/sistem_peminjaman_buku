<?php

namespace App\Http\Controllers\Master;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengunjungRequest;
use App\Models\Master\Pengunjung;
use App\Repositories\Pengujung\PengunjungRepository;
use App\Repositories\Pengujung\ValidasiPengunjungRepositori;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use PHPUnit\TextUI\Help;
use Validator;
use Yajra\DataTables\DataTables;

class PengunjungController extends Controller
{
    private $route  = 'master.pengunjung.';
    private $title  = 'Pengunjung';
    private $header = 'Master Pengunjung';


    public function index(){
        Helper::swal();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request, PengunjungRepository $pengunjungRepository) {
        return $pengunjungRepository->getDataTable($request);
    }

    public function create(){
        Helper::swal();
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => 'Create '. $this->header,
        ];
        return view($this->route.'create', $data);
    }

    public function store(Request $request, PengunjungRepository $pengunjungRepository){
        $validasi = new ValidasiPengunjungRepositori;
        $validasi = $validasi->validasiStore($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $pengunjungRepository->store($request);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }

    public function edit($id, PengunjungRepository $pengunjungRepository){
        Helper::swal();
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => 'Update '.$this->header,
            'data'   => $pengunjungRepository->getDataById($id),
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Pengunjung $pengunjung, PengunjungRepository $pengunjungRepository){
        $validasi = new ValidasiPengunjungRepositori;
        $validasi = $validasi->validasiStore($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $pengunjungRepository->update($request, $pengunjung);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
    public function destroy($data_id, PengunjungRepository $pengunjungRepository){
        try{
            $pengunjungRepository->destroy($data_id);
            $message = 'Sukses';
            $response = [
                'message' => $message,
                'status'   => true,
            ];
            return response()->json($response);
        }catch(Exception $e){
            $message = 'Gagal';
            $response = [
                'message' => $message,
                'status'   => false,
            ];
            return response()->json($response);
        }
    }

    public function changeStatusPengunjung($data_id, PengunjungRepository $pengunjungRepository){
        try{
            $pengunjungRepository->changeStatus($data_id);
            $message = 'Sukses';
            $response = [
                'message' => $message,
                'status'   => true,
            ];
            return response()->json($response);
        }catch(Exception $e){
            $message = 'Gagal';
            $response = [
                'message' => $message,
                'status'   => false,
            ];
            return response()->json($response);
        }
    }
}
