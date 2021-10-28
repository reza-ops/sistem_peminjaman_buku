<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;
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
        $cek_data = Peminjaman::where('no_transaksi_peminjaman', $request['kode'])->first();

        if(empty($cek_data)){
            $response = [
                'html' => '<br><h4 class="text-danger">Transaksi Tidak Di temukan</h4>'
            ];
            return response()->json($response);
        }

        $data = [
            'route' => $this->route,
            'data' => $cek_data,
            'total_harga' =>  Carbon::parse($cek_data['tanggal_pinjam'])->diffInDays(Carbon::parse($cek_data['tanggal_kembali'])) * Buku::whereIn('id', PeminjamanItems::where('peminjaman_id', $cek_data->id)->pluck('buku_id')->toarray())->sum('biaya_per_hari') ,
        ];

        $view = view($this->route . 'komponen.data_transaksi', $data)->render();

        $return = [
            'html' => $view,
        ];

        return response()->json($return);
    }
    public function selesaiTransaksi($transaksi_id){
        DB::beginTransaction();
        $cek_data = Peminjaman::where('id', $transaksi_id)->first();
        $update_data_peminjaman = $cek_data->update([
            'is_sudah_kembali' => 0
        ]);

        $get_buku = Buku::wherein('id', PeminjamanItems::where('peminjaman_id', $cek_data->id)->pluck('buku_id')->toarray())->update([
            'is_stock' => 0
        ]);

        if ($update_data_peminjaman && $get_buku) {
            DB::commit();
            $data=[
                'message' => 'Berhasil',
                'status'  => true,
                'data'    => $cek_data,
                'route'    => $this->route,
            ];
            return view($this->route.'pemberitauan_transaksi', $data);
        } else {
            DB::rollback();
            $data=[
                'message'=>'Gagal',
                'status'=>false,
            ];
            return redirect()->back();
        }
    }

}
