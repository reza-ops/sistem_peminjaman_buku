<?php

namespace App\Contracts\Kategori;

interface KategoriValidasiInterface {
    public function validasiStore($request);
    public function validasiUpdate($request);
}
