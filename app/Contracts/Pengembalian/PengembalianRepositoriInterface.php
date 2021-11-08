<?php

namespace App\Contracts\Pengembalian;

interface PengembalianRepositoriInterface {
    public function getDataByKode($kode);
    public function getDataById($data_id);
    public function updateTransaksi($transakasi);
    public function updateTransaksiItems($transakasi_id);
}
