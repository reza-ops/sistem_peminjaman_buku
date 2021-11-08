<?php

namespace App\Contracts\Pengunjung;

interface PengunjungValidasiInterface {
    public function validasiStore($request);
    public function validasiUpdate($request);
}
