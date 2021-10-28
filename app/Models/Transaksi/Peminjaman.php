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
}
