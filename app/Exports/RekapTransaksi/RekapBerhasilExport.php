<?php

namespace App\Exports\RekapTransaksi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RekapBerhasilExport implements FromView,ShouldAutoSize
{
    use Exportable;
    protected $data;

    function __construct($data) {
            $this->data = $data;
    }

    public function view(): View
    {
        return view('rekap_transaksi.berhasil.excel.rekap_excel', [
            'data_rekap_excel'   => $this->data['data'],
            'data_tanggal_awal'  => $this->data['tanggal_awal'],
            'data_tanggal_akhir' => $this->data['tanggal_akhir'],
        ]);

    }
}
