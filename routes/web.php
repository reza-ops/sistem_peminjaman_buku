<?php

use App\Http\Controllers\DaftarTransaksi\BelumKembaliController;
use App\Http\Controllers\DaftarTransaksi\BerhasilController;
use App\Http\Controllers\DaftarTransaksi\TerlambatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\BukuController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\PengunjungController;
use App\Http\Controllers\PengunjungBermasalahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapTransaksi\BelumKembaliController as RekapTransaksiBelumKembaliController;
use App\Http\Controllers\RekapTransaksi\BerhasilController as RekapTransaksiBerhasilController;
use App\Http\Controllers\RekapTransaksi\TerlambatController as RekapTransaksiTerlambatController;
use App\Http\Controllers\Transaksi\PeminjamanController;
use App\Http\Controllers\Transaksi\PengembalianBermasalahController;
use App\Http\Controllers\Transaksi\PengembalianController;
use App\Http\Controllers\UserManagement\RoleController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::post('send_message', [DashboardController::class, 'sendMessage'])->name('send_message');
Route::get('download_template_excel', [DashboardController::class, 'downloadTemplateExcel'])->name('download_template_excel');

Route::resource('profile', ProfileController::class);

Route::group([
    'prefix'       => 'user-management',
    'as'           => 'user_management.',
    'auth:sanctum' => 'verified',
],  function () {
    // route roles
    Route::resource('role', RoleController::class)->except('destroy','show');
    Route::get('role/get_data' ,[RoleController::class,'getData']);

});
Route::group([
    'prefix'       => 'master',
    'as'           => 'master.',
    'middleware'   => ['auth'],
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
    Route::get('pengunjung/change_status_pengunjung/{data_id}' ,[PengunjungController::class,'changeStatusPengunjung']);
});

Route::group([
    'prefix'       => 'transaksi',
    'as'           => 'transaksi.',
    'auth:sanctum' => 'verified',
    'middleware'   => ['auth'],
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
        Route::post('send_denda',[ PengembalianController::class,'sendDenda'])->name('send_denda');
        Route::post('get_biaya_lain_lain',[ PengembalianController::class,'getBiayaLainLain'])->name('get_biaya_lain_lain');
    });

    Route::resource('pengembalian_bermasalah', PengembalianBermasalahController::class)->only('index');
    Route::post('pengembalian_bermasalah/search_no_transaksi', [PengembalianBermasalahController::class,'searchNoTransaksi'])->name('pengembalian_bermasalah.search_no_transaksi');

});
Route::group([
    'prefix'     => 'daftar_transaksi',
    'as'         => 'daftar_transaksi.',
    'middleware' => ['auth'],
    ],  function ()  {
        Route::resource('berhasil', BerhasilController::class)->only('index');
        Route::get('berhasil/get_data' ,[BerhasilController::class,'getData']);
        Route::get('berhasil/{data_id}/detail' ,[BerhasilController::class,'detail']);

        Route::resource('terlambat', TerlambatController::class)->only('index','update');
        Route::get('terlambat/get_data' ,[TerlambatController::class,'getData']);
        Route::get('terlambat/{data_id}/detail' ,[TerlambatController::class,'detail']);

        Route::resource('belum_kembali', BelumKembaliController::class)->only('index');
        Route::get('belum_kembali/get_data' ,[BelumKembaliController::class,'getData']);
        Route::get('belum_kembali/{data_id}/detail' ,[BelumKembaliController::class,'detail']);
});
Route::group([
    'prefix'     => 'rekap_transaksi',
    'as'         => 'rekap_transaksi.',
    'middleware' => ['auth'],
    ],  function ()  {
        Route::resource('berhasil', RekapTransaksiBerhasilController::class)->only('index','store');

        Route::resource('belum_kembali', RekapTransaksiBelumKembaliController::class)->only('index','store');

        Route::resource('terlambat', RekapTransaksiTerlambatController::class)->only('index','store');
});
Route::resource('pengunjung_bermasalah', PengunjungBermasalahController::class)->only('index');
Route::group([
    'prefix'     => 'pengunjung_bermasalah',
    'as'         => 'pengunjung_bermasalah.',
    'middleware' => ['auth'],
], function () {
    Route::get('get_data' ,[PengunjungBermasalahController::class,'getData']);
    Route::get('update/{data_id}' ,[PengunjungBermasalahController::class,'update']);
    Route::get('cetak_excel' ,[PengunjungBermasalahController::class,'cetakExcel'])->name('cetak_excel');
});
