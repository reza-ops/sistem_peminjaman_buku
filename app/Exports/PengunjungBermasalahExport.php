<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengunjungBermasalahExport implements FromView,ShouldAutoSize
{
    use Exportable;
    protected $data;

    function __construct($data) {
            $this->data = $data;
    }

    public function view(): View
    {
        return view('pengunjung_bermasalah.excel.rekap_data', [
            'data_rekap_excel'   => $this->data['data'],
        ]);

    }
}
