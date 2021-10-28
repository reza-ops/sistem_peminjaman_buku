<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = [
        'nama',
        'kategori_id',
        'biaya_per_hari',
        'kode_buku',
        'is_stock',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'kategori_id', 'id');
    }
}
