<?php

namespace App\Contracts\DaftarTransaksi\Terlambat;

interface TerlambatRepositoriInterface {
    public function getDataTable($request);
    public function getDataById($data_id);
    public function updateDendaTerlambat($denda, $request);
}
