<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'categori_bukus';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function books(){
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }
}
