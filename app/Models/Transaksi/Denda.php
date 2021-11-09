<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'denda';
    protected $fillable = [
        'peminjaman_id',
        'total_terlambat',
        'total_biaya',
        'is_sudah_bayar_denda',
    ];
}
