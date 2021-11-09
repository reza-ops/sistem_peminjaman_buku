<?php

namespace App\Http\Controllers\DaftarTransaksi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Repositories\DaftarTransaksi\Berhasil\BerhasilRepositori;
use Illuminate\Http\Request;

class BerhasilController extends Controller{
    private $route = 'daftar_transaksi.berhasil.';
    private $title = 'Transaksi Berhasil';
    private $header = 'Transaksi Berhasil';

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
        $data = new BerhasilRepositori;
        $data = $data->getDataTable($request);
        return $data;
    }
    public function detail($data_id){
       $get_data_transaksi = new BerhasilRepositori;
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
}
