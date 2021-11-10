<html>
    <body>
        <table>
            <thead>
                <tr>
                    <td colspan="7" rowspan="2" style="font-size:24px;"><h1>Rekap Transaksi Terlambat</h1></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="7">Dari Tanggal : {{ \Carbon\Carbon::parse($data_tanggal_awal)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($data_tanggal_akhir)->format('d-m-Y') }} </td>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <th align="center" style="border:1px solid black">No</th>
                    <th align="center" style="border:1px solid black">Nomor Transaksi</th>
                    <th align="center" style="border:1px solid black">Tanggal Pinjam</th>
                    <th align="center" style="border:1px solid black">Tanggal Kembali</th>
                    <th align="center" style="border:1px solid black">Peminjam</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_rekap_excel as $key => $value )
                    <tr>
                        <td style="border:1px solid black" align="center">{{ $key + 1 }} </td>
                        <td style="border:1px solid black" align="center">{{ $value->no_transaksi_peminjaman }}</td>
                        <td style="border:1px solid black" align="center">{{ $value->tanggal_pinjam }}</td>
                        <td style="border:1px solid black" align="center">{{ $value->tanggal_kembali }}</td>
                        <td style="border:1px solid black" align="center">{{ $value->pengunjung->nama }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
