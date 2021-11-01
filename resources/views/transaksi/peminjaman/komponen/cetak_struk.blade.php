<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Struk</title>
    <style>
    @page { size: 8.5cm 9cm landscape; }
 </style>
</head>
<body>
    <p>Terimakasih Telah Meminjam Buku</p>
    <br>
    <br>
    <br>
    <br>
    <p>No Transaksi : {{ $peminjaman->no_transaksi_peminjaman }}</p>
    {!! DNS1D::getBarcodeHTML($peminjaman->no_transaksi_peminjaman, 'C128',1,30) !!}
</body>
</html>
