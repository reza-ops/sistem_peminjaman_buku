<?php

namespace App\Contracts\Peminjaman;

interface PeminjamanValidasiInterface {
    public function validasiPeminjaman($request);
    public function cekStatusBuku($request);
}
