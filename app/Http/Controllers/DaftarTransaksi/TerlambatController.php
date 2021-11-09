<?php

namespace App\Http\Controllers\DaftarTransaksi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Denda;
use App\Models\Transaksi\Peminjaman;
use App\Repositories\DaftarTransaksi\Terlambat\TerlambatRepositori;
use App\Repositories\DaftarTransaksi\Terlambat\TerlambatValidasiRepositori;
use Exception;
use Illuminate\Http\Request;

class TerlambatController extends Controller{
    private $route = 'daftar_transaksi.terlambat.';
    private $title = 'Transaksi Terlambat';
    private $header = 'Transaksi Terlambat';

    public function index(){
        Helper::swal();
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request){
        $data = new TerlambatRepositori;
        $data = $data->getDataTable($request);

        return $data;
    }
    public function detail($data_id){
        Helper::Swal();
        $get_data_transaksi = new TerlambatRepositori;
        $get_data_transaksi = $get_data_transaksi->getDataById($data_id);

        if(!empty($get_data_transaksi)){
             $data = [
                 'route'  => $this->route,
                 'title'  => $this->title,
                 'header' => $this->header,
                 'data'   => $get_data_transaksi,
             ];
             return view($this->route.'detail', $data);
        }else  {
             $message = 'ID Tidak Ditemukan';
             return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
     }

     public function update(Request $request, Denda $denda , TerlambatRepositori $terlambatRepositori){
        $validasi = new TerlambatValidasiRepositori;
        $validasi = $validasi->validasiUpdate($request);
        if($validasi['status'] == false){
            $message = Helper::parsing_alert($validasi['error']);
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
        try{
            $update_transaksi = $terlambatRepositori->updateDendaTerlambat($denda, $request);
            $message = 'Berhasil Update Transaksi';
            return redirect()->back()->with('success', Helper::parsing_alert($message));
        }catch(Exception $e){
            $message = 'Gagal';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
     }
}
