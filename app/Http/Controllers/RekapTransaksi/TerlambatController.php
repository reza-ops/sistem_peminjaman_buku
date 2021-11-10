<?php

namespace App\Http\Controllers\RekapTransaksi;

use App\Exports\RekapTransaksi\RekapTerlambatExport;
use App\Http\Controllers\Controller;
use App\Repositories\RekapTransaksi\Terlambat\TerlambatRepositori;
use Illuminate\Http\Request;

class TerlambatController extends Controller{
    private $route = 'rekap_transaksi.terlambat.';
    private $header = 'Rekap Transaki Terlambat';
    private $sub_header = 'Rekap Transaki Terlambat';

    public function index(){
        $data = [
            'route' => $this->route,
            'header' => $this->header,
            'sub_header' => $this->sub_header,
        ];

        return view($this->route.'index', $data);
    }

    public function store(Request $request){
        $get_data_peminjaman = new TerlambatRepositori;
        $get_data_peminjaman = $get_data_peminjaman->getData($request);

        $data = [
            'data'          => $get_data_peminjaman,
            'tanggal_awal'  => $request['tanggal_awal'],
            'tanggal_akhir' => $request['tanggal_akhir'],
        ];

        return (new RekapTerlambatExport($data))->download('rekap_transaksi_terlambat.xlsx');
    }
}
