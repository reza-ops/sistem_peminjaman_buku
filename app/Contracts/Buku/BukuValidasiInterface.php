<?php

namespace App\Contracts\Buku;

interface BukuValidasiInterface {
    public function validasiStore($request);
    public function validasiUpdate($request);
}
