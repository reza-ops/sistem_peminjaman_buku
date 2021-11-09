<?php

namespace App\GlobalFunction\SelectTwo;

use App\Models\Master\Pengunjung as MasterPengunjung;
use Illuminate\Http\Request;

class Pengunjung {
    public function select($request){
        $term = trim($request['nama']);
        $pengunjung = MasterPengunjung::getDataSelectTransaksi();
        if (!empty($request['not_in'])) {
            $id = collect($request['not_in']);
            $pengunjung = $pengunjung->whereNotIn('id', $id);
        }
        if (!empty($term)) {
            $pengunjung = $pengunjung->where('nama', 'like', '%' . $term . '%');
        }
        $pengunjung = $pengunjung->get();

        return $pengunjung;
    }
}
