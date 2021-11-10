<?php


namespace App\Http\Controllers\RekapTransaksi;

use App\Exports\RekapTransaksi\RekapBelumKembaliExport;
use App\Http\Controllers\Controller;
use App\Repositories\RekapTransaksi\BelumKembali\BelumKembaliRepositori;
use Illuminate\Http\Request;

class BelumKembaliController extends Controller{
    private $route = 'rekap_transaksi.belum_kembali.';
    private $header = 'Rekap Transaksi Belum Kembali';
    private $sub_header = 'Rekap Transaksi Belum Kembali';


    public function index(){
        $data = [
            'route'      => $this->route,
            'header'     => $this->header,
            'sub_header' => $this->sub_header,
        ];

        return view($this->route.'index', $data);
    }

    public function store(Request $request){
        $get_data_peminjaman = new BelumKembaliRepositori;
        $get_data_peminjaman = $get_data_peminjaman->getData($request);

        $data = [
            'data'          => $get_data_peminjaman,
            'tanggal_awal'  => $request['tanggal_awal'],
            'tanggal_akhir' => $request['tanggal_akhir'],
        ];

        return (new RekapBelumKembaliExport($data))->download('rekap_belum_kembali.xlsx');
    }
}
