<?php

namespace App\Http\Controllers\DaftarTransaksi;

use App\Http\Controllers\Controller;
use App\Repositories\DaftarTransaksi\BelumKembali\BelumKembaliRepositori;
use Illuminate\Http\Request;

class BelumKembaliController extends Controller{
    private $route = 'daftar_transaksi.belum_kembali.';
    private $header = 'Belum Kembali';
    private $sub_header = 'Belum Kembali';

    public function index(){
        $data = [
            'route'      => $this->route,
            'header'     => $this->header,
            'sub_header' => $this->sub_header,
        ];

        return view($this->route.'index', $data);
    }

    public function getData(Request $request){
        $data = new BelumKembaliRepositori;
        $data = $data->getDataTable($request);

        return $data;
    }

    public function detail($data_id){
        $get_data_peminjaman = new BelumKembaliRepositori;
        $get_data_peminjaman = $get_data_peminjaman->getDataById($data_id);

        $data = [
            'route'      => $this->route,
            'header'     => $this->header,
            'sub_header' => $this->sub_header,
            'data'       => $get_data_peminjaman,
        ];
        return view($this->route.'detail', $data);
    }
}

