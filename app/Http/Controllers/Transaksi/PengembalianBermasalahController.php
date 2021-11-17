<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Repositories\PengembalianBermasalah\PengembalianBermasalahRepositori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianBermasalahController extends Controller{
    private $route = 'transaksi.pengembalian_bermasalah.';
    private $header = 'Pengembalian Bermasalah';
    private $sub_header = 'Buku Rusak/ Hilang';

    public function index(){
        $data = [
            'route'      => $this->route,
            'header'     => $this->header,
            'sub_header' => $this->sub_header,
        ];

        return view($this->route.'index', $data);
    }

    public function searchNoTransaksi(Request $request){
        $data_peminjaman = new PengembalianBermasalahRepositori;
        $data_peminjaman = $data_peminjaman->getDataByKode($request['kode']);

        if(empty($data_peminjaman)){
            $response = [
                'html' => '<br><h4 class="text-danger">Transaksi Tidak Di temukan</h4>'
            ];
            return response()->json($response);
        }

        $data = [
            'route' => $this->route,
            'data' => $data_peminjaman,
        ];

        $view = view($this->route . 'komponen.data_transaksi', $data)->render();

        $return = [
            'html' => $view,
        ];

        return response()->json($return);
    }
}
