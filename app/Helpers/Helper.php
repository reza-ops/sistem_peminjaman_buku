<?php

namespace App\Helpers;

use App\Http\Controllers\Master\PengunjungController;
use App\Models\Master\Buku;
use App\Models\Master\Pengunjung as MasterPengunjung;
use App\Models\Perpustakaan\Pengunjung;
use App\Models\Transaksi\Peminjaman;
use Auth;
use ReflectionClass;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class Helper{
    public static function kode_buku($data)
    {
        $kode = 'KB'.date('ymd') . '';
        $cek_kode_buku = Buku::where('kode_buku', 'like', '%' . $kode . '%')
        ->select('kode_buku')
        ->orderBy('kode_buku', 'desc')
        ->first();

        if (!empty($cek_kode_buku)) {

            $get_angka_akhir = substr($cek_kode_buku->kode_buku, -3);
            $get_angka_akhir = $get_angka_akhir + 1;
            // dd($get_angka_akhir);

            $arr_angka = [
                '10' => '00',
                '100' => '0',
                '1000' => '',
            ];
            foreach ($arr_angka as $key_angka => $value_angka) {
//
                // dd($get_angka_akhir, $get_angka_akhir < $key_angka);
                if ($get_angka_akhir < $key_angka) {

                    $kode = $kode .$value_angka. $get_angka_akhir;
                    break;
                }
            }
        } else {

            $kode = $kode . '001';
        }

        return $kode;
    }

    public static function kode_pengunjung()
    {
        $kode = 'KP'.date('ymd') .'';
        $cek_kode_pengunjung = MasterPengunjung::where('kode_pengunjung', 'like', '%' . $kode . '%')
        ->select('kode_pengunjung')
        ->orderBy('kode_pengunjung', 'desc')
        ->first();

        if (!empty($cek_kode_pengunjung)) {

            $get_angka_akhir = substr($cek_kode_pengunjung->kode_pengunjung, -3);
            $get_angka_akhir = $get_angka_akhir + 1;
            // dd($get_angka_akhir);

            $arr_angka = [
                '10' => '00',
                '100' => '0',
                '1000' => '',
            ];
            foreach ($arr_angka as $key_angka => $value_angka) {
//
                // dd($get_angka_akhir, $get_angka_akhir < $key_angka);
                if ($get_angka_akhir < $key_angka) {

                    $kode = $kode .$value_angka. $get_angka_akhir;
                    break;
                }
            }
        } else {

            $kode = $kode . '001';
        }

        return $kode;
    }

    public static function kode_transaksi($data){
        $kode = 'KT'.date('ymd') . $data['pengunjung_id'].'';
        $cek_no_transaksi = Peminjaman::where('no_transaksi_peminjaman', 'like', '%' . $kode . '%')
        ->select('no_transaksi_peminjaman')
        ->orderBy('no_transaksi_peminjaman', 'desc')
        ->first();
        if ($cek_no_transaksi != null) {

            $get_angka_akhir = substr($cek_no_transaksi->no_transaksi_peminjaman, -3);
            $get_angka_akhir = $get_angka_akhir + 1;
            // dd($get_angka_akhir);

            $arr_angka = [
                '10' => '00',
                '100' => '0',
                '1000' => '',
            ];
            foreach ($arr_angka as $key_angka => $value_angka) {
//
                // dd($get_angka_akhir, $get_angka_akhir < $key_angka);
                if ($get_angka_akhir < $key_angka) {

                    $kode = $kode .$value_angka. $get_angka_akhir;
                    break;
                }
            }
        } else {

            $kode = $kode . '001';
        }

        return $kode;
    }
    public static function parsing_alert($message)
    {
        $string = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $string .= ucfirst($value) . '<br>';
            }
        } else {
            $string = ucfirst($message);
        }
        return $string;
    }

    public static function swal()
    {
        if (session('success')) {
            alert()->html('', session('success'), 'success');
        }

        if (session('error')) {
            alert()->html('', session('error'), 'error');
        }

        if (session('warning')) {
            alert()->html('', session('warning'), 'warning');
        }
    }

}
