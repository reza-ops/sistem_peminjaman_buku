<?php

namespace App\Contracts\Kategori;

use Illuminate\Http\Request;

interface KategoriRepositoryInterface
{
    public function getDataTable(Request $request);
    public function store($request);
    public function getDataById($id);
    public function update($request, $kategori);
    public function destroy($data_id);
}
