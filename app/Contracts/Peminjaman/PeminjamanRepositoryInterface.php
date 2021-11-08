<?php

namespace App\Contracts\Peminjaman;

interface PeminjamanRepositoryInterface {
    public function store($request);
    public function createPeminjamanItems($request, $peminjaman);
    public function updateStatusBuku($request);
    public function getDataById($data_id);
}
