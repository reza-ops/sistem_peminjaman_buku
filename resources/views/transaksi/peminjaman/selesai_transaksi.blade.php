<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transaksi Selesai</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('vendor') }}/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('/vendor/select2-bootstrap4-theme-master/dist/select2-bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5 row">
                                    <div class="text-center col-md-12">
                                        <h3 class="h3 text-gray-900 mb-4">TRANSAKSI BERHASIL</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center ">
                                            <h5 class="text-gray-900 mb-4">Detail Transaksi</h5>
                                            <p>No Transaksi : {{ $data->no_transaksi_peminjaman }}</p>
                                            <p>Atas Nama : {{ $data->pengunjung->nama }}</p>
                                            <p>Tanggal Pinjam : {{ $data->tanggal_pinjam }}</p>
                                            <p>Tanggal Kembali : {{ $data->tanggal_kembali }}</p>
                                            <p>Total Harga : Rp,  {{ number_format($count_tanggal, 2) }}</p>
                                            <p>Status : {{ $data->is_sudah_bayar == '1' ? 'Belum Bayar' : 'Sudah Bayar' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-info bg-back" href="{{ route($route.'index') }}">Kembali Ke Menu Peminjaman</a>
                                        <br>
                                        <br>
                                        <a target="_blank" class="btn btn-warning bg-back" href="{{ URL::to('transaksi/peminjaman/cetak_struk', ['data_id' =>$data->id]) }}">Cetak Struk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

</body>

</html>
