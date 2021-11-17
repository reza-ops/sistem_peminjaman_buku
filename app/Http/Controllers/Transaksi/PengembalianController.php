<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Transaksi\PeminjamanItems;
use App\Repositories\Pengembalian\PengembalianRepositori;
use App\Repositories\Pengembalian\PengembalianValidasiRepositori;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

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

    public function sendDenda(Request $request){
        $validasi = new PengembalianValidasiRepositori;
        $validasi = $validasi->validasi_send_denda($request);
        if($validasi['status'] == false) {
            $data=[
                'message'=>$validasi['error'],
                'status'=>false,
            ];
            return response()->json($data);
        }
        try{
            $data_send_denda = new PengembalianRepositori;
            $data_send_denda = $data_send_denda->sendDenda($request->all());
            $data=[
                'message'=>'Berhasil',
                'status'=>true,
            ];
            DB::commit();
            return response()->json($data);

        }catch(Exception $e){
            $data=[
                'message'=> 'Gagal',
                'status'=>false,
            ];
            return response()->json($data);
        }
    }

    public function getBiayaLainLain(Request $request){
        try{
            $data_send_denda = new PengembalianRepositori;
            $data_send_denda = $data_send_denda->getBiayaLain($request->all());
            $data=[
                'message' => 'Berhasil',
                'status'  => true,
                'data'    => $data_send_denda,
                'total'    => number_format(collect($data_send_denda)->pluck('total')->sum(),2),
            ];
            return response()->json($data);

        }catch(Exception $e){
            $data=[
                'message'=> 'Gagal',
                'status'=>false,
            ];
            return response()->json($data);
        }
    }

}
