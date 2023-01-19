<html>
    <body>
        <table>
            <thead>
                <tr>
                    <td colspan="7" rowspan="2" style="font-size:24px;"><h1>Data Pengunjung Bermasalah</h1></td>
                </tr>
                <tr></tr>
                <tr></tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <th align="center" style="border:1px solid black">No</th>
                    <th align="center" style="border:1px solid black">Nama</th>
                    <th align="center" style="border:1px solid black">Alamat</th>
                    <th align="center" style="border:1px solid black">Kode Pengunjung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_rekap_excel as $key => $value )
                    <tr>
                        <td style="border:1px solid black" align="center">{{ $key + 1 }} </td>
                        <td style="border:1px solid black" align="center">{{ $value->nama }}</td>
                        <td style="border:1px solid black" align="center">{{ $value->alamat }}</td>
                        <td style="border:1px solid black" align="center">{{ $value->kode_pengunjung }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
