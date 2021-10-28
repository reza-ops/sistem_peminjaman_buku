<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjung';
    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'is_boleh_pinjam',
        'kode_pengunjung',
    ];
}
