<?php

namespace App\Http\Controllers;

use App\Exports\PengunjungBermasalahExport;
use App\Helpers\Helper;
use App\Repositories\PengunjungBermasalahRepository;
use Illuminate\Http\Request;

class PengunjungBermasalahController extends Controller
{
    private $route  = 'pengunjung_bermasalah.';
    private $title  = 'Pengunjung Bermasalah ';
    private $header = 'Pengujung Bermasalah';

    public function __construct(PengunjungBermasalahRepository $pengunjungBermasalahRepository)
    {
        $this->mainRepo = $pengunjungBermasalahRepository;
        $this->middleware('auth');
    }

    public function index(){
        Helper::swal();
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request) {
        return $this->mainRepo->getDataTable($request);
    }

    public function update($data_id){
        try{
            $this->mainRepo->update($data_id);
            $message = 'Sukses';
            $response = [
                'message' => $message,
                'status'   => true,
            ];
            return response()->json($response);
        }catch(Exception $e){
            $message = 'Gagal';
            $response = [
                'message' => $message,
                'status'   => false,
            ];
            return response()->json($response);
        }
    }

    public function cetakExcel(){
        $get_data = $this->mainRepo->getData();

        $data = [
            'data'          => $get_data,
        ];

        return (new PengunjungBermasalahExport($data))->download('data_pengunjung_bermasalah.xlsx');
    }

}
