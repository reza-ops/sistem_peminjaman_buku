<?php

namespace App\Models\Transaksi;

use App\Models\Master\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanItems extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_items';
    protected $fillable = [
        'peminjaman_id',
        'buku_id',
    ];

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
