<?php

namespace App\Http\Controllers\Transaksi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use App\Repositories\Peminjaman\PeminjamanRepository;
use App\Repositories\Peminjaman\ValidasiPeminjamanRepositori;
use App\Services\Filter;
use App\Services\SelectTwoService;
use Carbon\Carbon;
use Exception;
use Validator;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    private $route = 'transaksi.peminjaman.';
    private $title = 'Peminjaman';
    private $header = 'Peminjaman';


    public function index(){
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function searchKodeBuku(Request $request, Filter $filter){
        $buku = $filter->initialize('buku', $request);
        $data = $buku->filter($request);

        if(empty($data)){
            $response = [
                'html' => '<br><h4 class="text-danger">Buku Tidak Di temukan</h4>'
            ];
            return response()->json($response);
        }
        $data = [
            'route' => $this->route,
            'data' => $data,
        ];

        $view = view($this->route . 'komponen.data_buku', $data)->render();

        $return = [
            'html' => $view,
        ];

        return response()->json($return);

    }

    public function selectPengujung(Request $request, SelectTwoService $selectTwoService){
        $select = $selectTwoService->initialize('pengunjung', $request);
        $response = $select->select($request);
        $data= [];
        foreach ($response as $key => $value) {
            $data[] = ['id' => $value->id, 'text' => $value->nama ];
        }
        return response()->json($data);
    }

    public function store(Request $request, PeminjamanRepository $peminjamanRepository){

        // start manual validasi menggunakan class
        $validasi = new ValidasiPeminjamanRepositori;
        $validasi = $validasi->validasiPeminjaman($request);
        if($validasi['status'] == false) {
            $data=[
                'message'=> Helper::parsing_alert($validasi['error']),
                'status'=>false,
            ];
            return response()->json($data);
        }
        // end manual validasi menggunakan class

        // start cek status buku menggunakan class
        $cek_status_buku = new ValidasiPeminjamanRepositori;
        $cek_status_buku = $cek_status_buku->cekStatusBuku($request->buku_id);
        if($cek_status_buku['status'] == false) {
            $data=[
                'message'=>$cek_status_buku['error'],
                'status'=>false,
            ];
            return response()->json($data);
        }
        // end cek status buku menggunakan class

        // peminjaman proses
        try{
            $create_peminjaman       = $peminjamanRepository->store($request);
            DB::beginTransaction();
            $create_peminjaman_items = $peminjamanRepository->createPeminjamanItems($request, $create_peminjaman);
            $update_status_buku      = $peminjamanRepository->updateStatusBuku($request);
            $data=[
                'message'=>'Berhasil',
                'status'=>true,
                'peminjaman'=>$create_peminjaman,
                'url_finish_transaksi' => route($this->route.'get_detail_transaksi', ['data_id' => $create_peminjaman->id])
            ];
            DB::commit();
            return response()->json($data);

        }catch(Exception $e){
            DB::rollback();
            $data=[
                'message'=>'Gagal',
                'status'=>false,
            ];
            return response()->json($data);
        }
    }
    public function getDetailTransaksi($data_id){

        $data_peminjaman = New PeminjamanRepository;
        $data_peminjaman = $data_peminjaman->getDataById($data_id);
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $data_peminjaman,
            'count_tanggal' =>  Carbon::parse($data_peminjaman['tanggal_pinjam'])->diffInDays(Carbon::parse($data_peminjaman['tanggal_kembali'])) * Buku::whereIn('id', PeminjamanItems::where('peminjaman_id', $data_peminjaman->id)->pluck('buku_id')->toarray())->sum('biaya_per_hari') ,
        ];
        return view($this->route.'selesai_transaksi', $data);
    }

    public function cetakStruk($data_id){
        $data_peminjaman = new PeminjamanRepository;
        $data_peminjaman = $data_peminjaman->getDataById($data_id);

        if(!empty($data_peminjaman)){
            $pdf = PDF::loadview($this->route.'komponen.cetak_struk',['peminjaman'=>$data_peminjaman]);
            return $pdf->stream();
        }else{
            $message = 'Data Tidak Ditemukan';
            return redirect()->back()->with('error', Helper::parsing_alert($message));
        }
    }
}
