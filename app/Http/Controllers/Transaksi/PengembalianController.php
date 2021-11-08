<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Transaksi\PeminjamanItems;
use App\Repositories\Pengembalian\PengembalianRepositori;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    private $route = 'transaksi.pengembalian.';
    private $title = 'Pengembalian';
    private $header = 'Pengembalian';


    public function index(){
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function searchNoTransaksi(Request $request){
        $data_peminjaman = new PengembalianRepositori;
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
            'total_harga' =>  Carbon::parse($data_peminjaman['tanggal_pinjam'])->diffInDays(Carbon::parse($data_peminjaman['tanggal_kembali'])) * Buku::whereIn('id', PeminjamanItems::where('peminjaman_id', $data_peminjaman->id)->pluck('buku_id')->toarray())->sum('biaya_per_hari') ,
        ];

        $view = view($this->route . 'komponen.data_transaksi', $data)->render();

        $return = [
            'html' => $view,
        ];

        return response()->json($return);
    }
    public function selesaiTransaksi($data_id){
        DB::beginTransaction();
        $data_peminjaman = new PengembalianRepositori;
        $data_peminjaman = $data_peminjaman->getDataById($data_id);
        try{
            $update_transaksi_items = new PengembalianRepositori;
            $update_transaksi_items = $update_transaksi_items->UpdateTransaksiItems($data_peminjaman->id);

            $update_transaksi = new PengembalianRepositori;
            $update_transaksi = $update_transaksi->updateTransaksi($data_peminjaman);
            DB::commit();
            $data=[
                'message' => 'Berhasil',
                'status'  => true,
                'data'    => $data_peminjaman,
                'route'    => $this->route,
            ];
            return view($this->route.'pemberitauan_transaksi', $data);
        }catch(Exception $e){
            DB::rollBack();
            $data=[
                'message'=>'Gagal',
                'status'=>false,
            ];
            return redirect()->back();
        }
    }

}
