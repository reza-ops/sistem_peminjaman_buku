<?php

namespace App\Http\Controllers\RekapTransaksi;

use App\Exports\RekapTransaksi\RekapBerhasilExport;
use App\Http\Controllers\Controller;
use App\Repositories\RekapTransaksi\Berhasil\BerhasilRepositori;
use Illuminate\Http\Request;

class BerhasilController extends Controller{
    private $route = 'rekap_transaksi.berhasil.';
    private $header = 'Rekap Transaksi Berhasil';
    private $sub_header = 'Rekap Transaksi';

    public function index(){
        $data = [
            'route'      => $this->route,
            'header'     => $this->header,
            'sub_header' => $this->sub_header,
        ];

        return view($this->route.'index', $data);
    }

    public function store(Request $request){
        $get_data_peminjaman = new BerhasilRepositori;
        $get_data_peminjaman = $get_data_peminjaman->getData($request);

        $data = [
            'data'          => $get_data_peminjaman,
            'tanggal_awal'  => $request['tanggal_awal'],
            'tanggal_akhir' => $request['tanggal_akhir'],
        ];

        return (new RekapBerhasilExport($data))->download('rekap_transaksi_berhasil.xlsx');
    }
}
