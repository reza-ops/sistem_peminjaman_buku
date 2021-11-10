<?php

namespace App\Contracts\DaftarTransaksi\BelumKembali;

interface BelumKembaliRepositoriInterface {
    public function getDataTable($request);
    public function getDataById($data_id);
}
