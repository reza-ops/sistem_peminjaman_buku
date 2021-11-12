<?php

namespace App\Http\Controllers;

use App\Models\Master\Buku;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $title = 'Dashboard';
    private $header = 'Dashboard';

    public function index(){
        $get_data_peminjaman = Peminjaman::get();
        $data_buku = [];

        $period = CarbonPeriod::create(Carbon::now()->firstOfMonth(), Carbon::now()->endOfMonth());
        foreach ($period as $key => $date) {
            $data_hari[$key] = $date->format('d');
            $data_peminjam[$key] =  $get_data_peminjaman->where('tanggal_pinjam',$date->format('Y-m-d'))->count();
        }

        $get_data_buku = PeminjamanItems::groupBy('buku_id')
        ->selectRaw('count(buku_id) as sum, buku_id')
        ->pluck('sum','buku_id');

        foreach($get_data_buku as $key => $value){
            $data_buku[$key] = [
            'name' => Buku::where('id', $key)->first()->nama,
            'y' => $value,
            ];
        }


        // dd(array_merge($data_buku), $data_peminjam);
        $data = [
            'title'    => $this->title,
            'header'   => $this->header,
            'hari'     => $data_hari,
            'peminjam' => $data_peminjam,
            'bulan' => [
                'Peminjaman Buku Di bulan '.Carbon::now()->format('F'),
            ],
            'buku' => array_merge($data_buku),
        ];
        return view('dashboard', $data);
    }
}
