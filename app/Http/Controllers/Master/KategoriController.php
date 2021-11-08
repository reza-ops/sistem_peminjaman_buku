<?php

namespace App\Http\Controllers\Master;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use App\Repositories\Kategori\KategoriRepository;
use App\Repositories\Kategori\ValidasiRepository;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private $route = 'master.kategori.';
    private $title = 'Kategori';
    private $header = 'Kategori';

    public function index(){
        Helper::swal();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request, KategoriRepository $kategoriRepository) {
        return $kategoriRepository->getDataTable($request);
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

    public function store(Request $request,KategoriRepository $kategoriRepository){

        $validasi = new ValidasiRepository;
        $validasi = $validasi->validasiStore($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $kategoriRepository->store($request);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }

    public function edit(KategoriRepository $kategoriRepository, $id){
        Helper::swal();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $kategoriRepository->getDataById($id),
        ];
        return view($this->route.'update', $data);
    }

    public function update(Request $request, Kategori $kategori, KategoriRepository $kategoriRepository){
        $validasi = new ValidasiRepository;
        $validasi = $validasi->validasiUpdate($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $kategoriRepository->update($request, $kategori);
            $message = 'Berhasil';
            return redirect(route($this->route.'index'))->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
    public function destroy($data_id, KategoriRepository $kategoriRepository){
        try{
            $kategoriRepository->destroy($data_id);
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
