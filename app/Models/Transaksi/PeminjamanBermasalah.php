<?php

namespace App\Models\Transaksi;

use App\Models\Master\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBermasalah extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_bermasalah';
    protected $fillable = [
        'buku_id',
        'transaksi_id',
        'denda',
        'keterangan',
    ];
    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
