<?php

namespace App\Models\Transaksi;

use App\Models\Master\Pengunjung;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'pengunjung_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'is_sudah_bayar',
        'is_sudah_kembali',
        'is_terlambat_kembali',
        'no_transaksi_peminjaman',
    ];

    public function pengunjung(){
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id', 'id');
    }
    public function peminjaman_item(){
        return $this->hasMany(PeminjamanItems::class, 'peminjaman_id', 'id');
    }

    public static function getDataTableBerhasil(){
        $query = self::where('is_sudah_kembali',0)->where('is_terlambat_kembali',0);
        return $query;
    }

    public static function getDataTableTerlambat(){
        $query = self::where('is_sudah_kembali',0)->where('is_terlambat_kembali',1);
        return $query;
    }

    public function denda(){
        return $this->hasOne(Denda::class, 'peminjaman_id', 'id');
    }
}
