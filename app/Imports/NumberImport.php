<?php

namespace App\Imports;

use App\Model\Data\StockRelease;
use Maatwebsite\Excel\Concerns\ToModel;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Helpers\Helper;
use Auth;


class NumberImport implements ToModel, WithHeadingRow, WithStartRow
// class StockReleaseImport implements ToCollection, WithHeadingRow
{
    private $route = 'admin.data.stock_darah.';
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow(): int
    {
        return 1;
    }

    public function startRow(): int
{
    return 2;
}

    public function model(Array $row)
    {
        // foreach ($rows as $row)
        // {
            return ([
                'nomor'            => $row['nomor'],
            ]);

    }

    // public function batchSize(): int
    // {
    //     return 1000;
    // }

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }
}
