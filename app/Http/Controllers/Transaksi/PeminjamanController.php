<?php

namespace App\Http\Controllers\Transaksi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Master\Buku;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;
use Validator;
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

    public function searchKodeBuku(Request $request){
        $cek_data = Buku::where('kode_buku', $request['kode'])->first();

        if(empty($cek_data)){
            $response = [
                'html' => '<br><h4 class="text-danger">Buku Tidak Di temukan</h4>'
            ];
            return response()->json($response);
        }

        $data = [
            'route' => $this->route,
            'data' => $cek_data,
        ];

        $view = view($this->route . 'komponen.data_buku', $data)->render();

        $return = [
            'html' => $view,
        ];

        return response()->json($return);

    }

    public function selectPengujung(Request $request){
        if (session('error')) {
            alert()->html('', session('error'), 'error');
        }
        $term = trim($request['no_kantong']);


        $pengunjung = Pengunjung::query();

        if (!empty($request['not_in'])) {
            $id = collect($request['not_in']);
            $pengunjung = $pengunjung->whereNotIn('id', $id);
        }
        if (!empty($term)) {
            $pengunjung = $pengunjung->where('no_kantong', 'like', '%' . $term . '%');
        }
        $pengunjung = $pengunjung->get();
        $response = [];

        foreach ($pengunjung as $key => $value) {
            $response[] = ['id' => $value->id, 'text' => $value->nama ];
        }

        return response()->json($response);
    }

    public function store(Request $request){
        $rules = [
            'pengunjung'        => 'required',
            'tanggal_pinjam'       => 'required',
            'tanggal_kembali' => 'required',
        ];

        $alert = [
            'required'  => ':attribute harus diisi',
            'min'       => ':attribute Min :min Char'
        ];
        $validator = Validator::make($request->all(), $rules, $alert);

        if ($validator->passes()) {

            if(empty($request->buku_id)){
                $data=[
                    'message'=> 'Belum Memilih Buku',
                    'status'=>false,
                ];
                return response()->json($data);
            }
            if(count(array_unique($request->buku_id))<count($request->buku_id))
            {
                $data=[
                    'message'=> 'Buku Tidak Boleh Sama',
                    'status'=>false,
                ];
                return response()->json($data);
            }


            $data_kode_buku = [
                'pengunjung_id' => $request['pengunjung']
            ];
            $create_kode_transaksi = Helper::kode_transaksi($data_kode_buku);
            $request['pengunjung_id'] = $request['pengunjung'];
            $request['no_transaksi_peminjaman'] = $create_kode_transaksi;
            $request['is_sudah_kembali'] = 1;
            $request['is_terlambat_kembali'] = 1;
            $request['is_sudah_bayar'] = $request['sudah_bayar'];

            $query = Peminjaman::create($request->all());
            DB::beginTransaction();


            foreach($request->buku_id as $key => $value){

                $create_peminajamn_item[$key] = PeminjamanItems::create([
                    'peminjaman_id' => $query->id,
                    'buku_id' => $value,
                ]);

                $d_stock_buku = [
                    'is_stock' => 1,
                ];

                $update_status_buku[$key] = Buku::where('id', $value)->update($d_stock_buku);
            }

            if ($query && $create_peminajamn_item && $update_status_buku) {
                DB::commit();
                $data=[
                    'message'=>'Berhasil',
                    'status'=>true,
                    'peminjaman'=>$query,
                    'url_finish_transaksi' => route($this->route.'get_detail_transaksi', ['data_id' => $query->id])
                ];
                return response()->json($data);
            } else {
                DB::rollback();
                $data=[
                    'message'=>'Gagal',
                    'status'=>false,
                ];
                return response()->json($data);
            }
        }
        $data=[
            'message'=> Helper::parsing_alert($validator->errors()->all()),
            'status'=>false,
        ];
        return response()->json($data);
    }
    public function getDetailTransaksi($data_id){

        $data_peminjaman = Peminjaman::where('id', $data_id)->first();
        $data = [
            'route' => $this->route,
            'title' => $this->title,
            'header' => $this->header,
            'data' => $data_peminjaman,
            'count_tanggal' =>  Carbon::parse($data_peminjaman['tanggal_pinjam'])->diffInDays(Carbon::parse($data_peminjaman['tanggal_kembali'])) * Buku::whereIn('id', PeminjamanItems::where('peminjaman_id', $data_peminjaman->id)->pluck('buku_id')->toarray())->sum('biaya_per_hari') ,
        ];
        return view($this->route.'selesai_transaksi', $data);
    }
}
