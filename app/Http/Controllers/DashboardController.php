<?php

namespace App\Http\Controllers;

use App\Exports\TemplateExcelExport;
use App\Helpers\Helper;
use App\Imports\NumberImport;
use App\Models\Master\Buku;
use App\Models\Master\Kategori;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanItems;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use AamDsam\Bpjs\PCare;
use App\Models\User;

class DashboardController extends Controller
{
    private $title = 'Dashboard';
    private $header = 'Dashboard';

    public function index(){
        dd(User::find(1));
    //     $data = "testtesttest";
    //     $secretKey = "secretkey";

    // // Computes the signature by hashing the salt with the secret key as the key
    //     $signature = hash_hmac('sha256', $data, $secretKey, true);

    //     // base64 encode…
    //     $encodedSignature = base64_encode($signature);

    //     // urlencode…
    //     // $encodedSignature = urlencode($encodedSignature);

    //     dd("Voila! A signature: " . $encodedSignature);
        // $username = 'reza';
        // $password = 'asd';
        // $kdAplikasi =1233;
        // dd(Base64_encode($username.$password.$kdAplikasi));
        // $buku                 = new Buku();
        // $buku->kode_buku      = '123123';
        // $buku->nama           = null;
        // $buku->kategori_id    = '2';
        // $buku->biaya_per_hari = '10000';
        // $buku->penerbit       = 'reza';
        // $buku->tanggal_terbit = '15-08-2001';
        // $buku->is_stock       = 0;
        // $buku->save();
        // $buku = Buku::where('id', 28)
        // ->with(['kategori'])
        // ->first();
        // dd($buku->kategori->nama);

        // return $buku;

        // $data = Buku::where('id', 1)
        // ->firstor(function(){
        //     dd('asd');
        // });
        // dd('asd');


        // Mail::send(
        //     new SendMail(
        //         'rezaeka345@gmail.com',
        //         'subject',
        //         'mail.bc_survey',
        //         '',
        //         ''
        //     )
        // );


        Helper::swal();
        $get_data_peminjaman = Peminjaman::get();
        $data_buku = [];

        $period = CarbonPeriod::create(Carbon::now()->firstOfMonth(), Carbon::now()->endOfMonth());
        foreach ($period as $key => $date) {
            $data_hari[$key] = $date->format('d');
            $data_peminjam[$key] =  $get_data_peminjaman->where('tanggal_pinjam',$date->format('Y-m-d'))->count();
        }

        $get_data_buku = PeminjamanItems::groupBy('buku_id')
        ->selectRaw('count(buku_id) as sum, buku_id')
        ->pluck('sum','buku_id');

        foreach($get_data_buku as $key => $value){
            $data_buku[$key] = [
            'name' => Buku::where('id', $key)->first()->nama,
            'y' => $value,
            ];
        }


        // dd(array_merge($data_buku), $data_peminjam);
        $data = [
            'title'    => $this->title,
            'header'   => $this->header,
            'hari'     => $data_hari,
            'peminjam' => $data_peminjam,
            'bulan' => [
                'Peminjaman Buku Di bulan '.Carbon::now()->format('F'),
            ],
            'buku' => array_merge($data_buku),
        ];
        return view('dashboard', $data);
    }


    // dummy

    public function sendMessage(Request $request){
        $post = $request->all();
        $file = $request->file('file');
        $data = Excel::toArray(new NumberImport, $file);

        foreach($data[0] as $key  => $value){
            $send_data[$key] = $this->send($value['nomor'], $post['message']);
        }

        $message = 'Berhasil Mengirim Broadcast';
        return redirect(route('dashboard'))->with('success', Helper::parsing_alert($message));

    }

    public function send($nomor, $message){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://localhost:8000/send-message/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "number=".$nomor."@c.us&message=".$message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        return $server_output;
    }

    public function downloadTemplateExcel(){
        return (new TemplateExcelExport())->download('template_excel.xlsx');
    }
}
