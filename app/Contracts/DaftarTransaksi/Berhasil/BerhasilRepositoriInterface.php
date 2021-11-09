<?php

namespace App\Contracts\DaftarTransaksi\Berhasil;

interface BerhasilRepositoriInterface {
    public function getDataTable($request);
    public function getDataById($data_id);
}
