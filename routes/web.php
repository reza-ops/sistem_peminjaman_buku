<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\BukuController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\PengunjungController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transaksi\PeminjamanController;
use App\Http\Controllers\Transaksi\PengembalianController;
use App\Models\Master\Pengunjung;
use App\Models\Transaksi\Peminjaman;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::post('logged_in', [LoginController::class, 'authenticate'])->name('logged_in');
Route::post('regisrasi_action', [LoginController::class, 'registrasi'])->name('regsitrasi_action');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('profile', ProfileController::class);

Route::group([
    'prefix'    => 'master',
    'as'        => 'master.',
    'auth:sanctum'=> 'verified',
],  function () {
    // route kategori
    Route::resource('kategori', KategoriController::class)->except('destroy','show');
    Route::get('kategori/hapus/{data_id}',[KategoriController::class,'destroy']);
    Route::get('kategori/get_data' ,[KategoriController::class,'getData']);

    // route buku
    Route::resource('buku', BukuController::class)->except('destroy','show');
    Route::get('buku/hapus/{data_id}',[BukuController::class,'destroy']);
    Route::get('buku/get_data' ,[BukuController::class,'getData']);
    Route::get('buku/cetak_barcode/{data_id}' ,[BukuController::class,'cetakBarcode']);


    // route pengunjung
    Route::resource('pengunjung', PengunjungController::class)->except('destroy','show');
    Route::get('pengunjung/hapus/{data_id}',[PengunjungController::class,'destroy']);
    Route::get('pengunjung/get_data' ,[PengunjungController::class,'getData']);
});

Route::group([
    'prefix'    => 'transaksi',
    'as'        => 'transaksi.',
    'auth:sanctum'=> 'verified',
],  function ()  {
    Route::resource('peminjaman', PeminjamanController::class)->only('index','store');
    Route::group([
        'prefix'    => 'peminjaman',
        'as'        => 'peminjaman.',
    ], function () {

        Route::post('search_kode_buku',[ PeminjamanController::class,'searchKodeBuku'])->name('search_kode_buku');
        Route::get('select_pengunjung',[ PeminjamanController::class,'selectPengujung'])->name('select_pengunjung');
        Route::get('get_detail_transaksi/{data_id}',[ PeminjamanController::class,'getDetailTransaksi'])->name('get_detail_transaksi');
        Route::get('cetak_struk/{data_id}',[ PeminjamanController::class,'cetakStruk']);
    });

    Route::resource('pengembalian', PengembalianController::class)->only('index','store');
    Route::group([
        'prefix'    => 'pengembalian',
        'as'        => 'pengembalian.',
    ], function () {
        Route::post('search_no_transaksi',[ PengembalianController::class,'searchNoTransaksi'])->name('search_no_transaksi');
        Route::get('selesai_transaksi/{transaksi_id}',[ PengembalianController::class,'selesaiTransaksi'])->name('selesai_transaksi');
    });
});
