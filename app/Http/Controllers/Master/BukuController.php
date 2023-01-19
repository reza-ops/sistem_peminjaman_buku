<?php

namespace App\Http\Controllers\Master;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BukuRequest;
use App\Models\Master\Buku;
use App\Models\Master\Kategori;
use App\Repositories\Buku\BukuRepository;
use App\Repositories\Buku\ValidasiBukuRepository;
use Exception;
use Illuminate\Http\Request;
use PDF;

class BukuController extends Controller
{
    private $route  = 'master.buku.';
    private $title  = 'Buku';
    private $header = ' Master Buku';

    public function __construct(BukuRepository $bukuRepository)
    {
        $this->mainRepo = $bukuRepository;
        $this->middleware('auth');
    }

    public function index(){
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request) {
        return $this->mainRepo->getDataTable($request);
    }

    public function create(){
        $data = [
            'route'    => $this->route,
            'title'    => $this->title,
            'header'   => 'Create '. $this->header,
            'kategori' => Kategori::get(),
        ];
        return view($this->route.'create', $data);
    }

    public function store(Request $request){
        $validasi = new ValidasiBukuRepository;
        $validasi = $validasi->validasiStore($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $this->mainRepo->store($request);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }

    public function edit($data_id){
        $data = [
            'route'    => $this->route,
            'title'    => $this->title,
            'header'   => 'Update '.$this->header,
            'data'     => $this->mainRepo->getDataById($data_id),
            'kategori' => Kategori::get(),
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Buku $buku){
        $validasi = new ValidasiBukuRepository;
        $validasi = $validasi->validasiStore($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $this->mainRepo->update($request, $buku);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
    public function destroy($data_id){
        try{
            $this->mainRepo->destroy($data_id);
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

    public function cetakBarcode($data_id){
        try{
            $pdf = PDF::loadview($this->route.'komponen.cetak_barcode',[
                'buku'=>$this->mainRepo->getDataById($data_id)
            ]);
            return $pdf->stream();
        }catch(Exception $e){
            $message = 'Data Tidak Ditemukan';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
}
