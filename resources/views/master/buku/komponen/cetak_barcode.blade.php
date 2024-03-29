<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
    <style>
            @page { size: 5cm 6cm landscape; }
    </style>
</head>
<body>
    <div style="margin: 0">
        <p style="font-size: 10px; font-weight: bold;">{{ $buku->nama }}</p>
        {!! DNS1D::getBarcodeHTML($buku->kode_buku, 'C128',1,30) !!}
        <p style="font-size: 5px">{{ $buku->kode_buku }}</p>
    </div>
</body>
</html>
