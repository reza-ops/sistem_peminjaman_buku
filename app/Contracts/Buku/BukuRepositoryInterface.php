<?php

namespace App\Contracts\Buku;

use Illuminate\Http\Request;

interface BukuRepositoryInterface
{
    public function store(Request $request);
    public function getDataTable(Request $request);
    public function getDataById($data_id);
    public function update(Request $request,$buku);
    public function destroy($data_id);
}
