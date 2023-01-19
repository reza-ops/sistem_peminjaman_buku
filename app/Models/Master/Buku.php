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
        'penerbit',
        'tanggal_terbit',
    ];

    public function kategori(){
        return $this->hasOne(Kategori::class,'id', 'kategori_id')->withDefault([
            'nama'=> 'Default reza'
        ]);
    }

    public static function boot(){
        parent::boot();

        self::creating(function ($model){
            Kategori::create([
                'nama'      => $model->nama,
                'deskripsi' => $model->kode_buku,
            ]);
        });
    }
}
