<?php

namespace App\Contracts\Pengunjung;

interface PengunjungRepositoryInterface{
    public function getDataTable($request);
    public function store($request);
    public function getDataById($data_id);
    public function update($request, $pengunjung);
    public function destroy($data_id);
    public function changeStatus($data_id);
}
