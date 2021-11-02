<div class="col-md-6">
    <div class="form-group">
        <label for="no_transaksi_peminjaman"> No Transaksi </label>
        <input type="text" name="" value="{{ $data->no_transaksi_peminjaman }}" class="form-control" readonly id="no_transaksi_peminjaman" >
    </div>
    <div class="form-group">
        <label for="nama"> Nama Peminjam </label>
        <input type="text" name="" value="{{ $data->pengunjung->nama }}" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Lama Meminjam </label>
        <input type="text" name="" value="{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->diffInDays(\Carbon\Carbon::parse($data->tanggal_kembali)) }} Hari" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Total Tagihan </label>
        <input type="text" name="" value="Rp, {{ number_format($total_harga, 2) }} {{ $data->is_sudah_bayar == '0' ? 'Sudah Bayar' : 'Belum Bayar' }}" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Keterangan </label>
        @if ($data->is_sudah_kembali == '0')
        <textarea class="form-control" readonly> Transaksi Selesai</textarea>
        @else
        <textarea class="form-control" readonly> {{ \Carbon\Carbon::parse($data->tanggal_kembali) < \Carbon\Carbon::now() ? 'Telat Mengembalikan Pengunjung Tidak Bisa Meminjam Sebelum Diupdate Oleh Admin' : '-' }}</textarea>
        @endif
    </div>
    @if ($data->is_sudah_kembali == '0')
        <a class="btn btn-warning bg-back" >Transaksi Sudah Diselesaikan</a>
    @else
        <a class="btn btn-danger bg-back" href="{{ route($route.'selesai_transaksi', ['transaksi_id' => $data->id]) }}">Selesai Transaksi</a>
    @endif
</div>
<div class="col-md-6">
    <label for="nama"> Daftar Buku </label>
    @foreach ($data->peminjaman_item as $item)
        <div class="form-group">
            <input type="text" name="" value="{{ $item->buku->nama }}" class="form-control" readonly >
        </div>
    @endforeach
</div>
{{--  --}}
