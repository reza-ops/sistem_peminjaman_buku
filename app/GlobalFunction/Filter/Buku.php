<?php

namespace App\GlobalFunction\Filter;

use App\Models\Master\Buku as MasterBuku;

class Buku {
    public function filter($request){
        $cek_data = MasterBuku::where('kode_buku', $request['kode'])->first();
        return $cek_data;
    }
}
