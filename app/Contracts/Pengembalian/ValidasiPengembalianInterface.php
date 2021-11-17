<?php

namespace App\Contracts\Pengembalian;

interface ValidasiPengembalianInterface {
    public function validasi_send_denda($request);
}
