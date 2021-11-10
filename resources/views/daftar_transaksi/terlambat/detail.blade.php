@extends('layouts.app')
@section('content')

<div class="card shadow mt-2">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">Detail Transaksi{{ $header }}</h2>
            </div>
            <div class="col text-right">
                <a href="{{ route($route. 'index') }}" class="btn btn-success">Kembali</a>
            </div>
        </div>
    </div>

    <div class="card-body row">
        <div class="col-md-6">
            <h3>Informasi Transaksi</h3>
            <div class="form-group">
                <label for="nama"> No Transaksi </label>
                <input type="text" name="nama" value="{{ $data->no_transaksi_peminjaman }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="nama"> Tanggal Pinjam </label>
                <input type="text" name="nama" value="{{ $data->tanggal_pinjam }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="nama"> Tanggal Kembali </label>
                <input type="text" name="nama" value="{{ $data->tanggal_kembali }}" class="form-control" readonly>
            </div>
            <br>
            <h3>Informasi Denda</h3>
            <form action="{{ route('daftar_transaksi.terlambat.update', $data->denda->id) }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="denda_id" value="{{ $data->denda->id }}">
                <div class="form-group">
                    <label for="nama">Total Terlambat </label>
                    <input type="text" value="{{ $data->denda->total_terlambat }} Hari" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="total_biaya">Total Biaya </label>
                    <input type="number" name="total_biaya" value="{{ $data->denda->total_biaya }}" class="form-control" {{  is_null($data->denda->total_biaya) ? '' : 'readonly' }}>
                </div>
                @if ($data->denda->is_sudah_bayar_denda == '1')
                <div class="form-group">
                    <label for="is_sudah_bayar_denda"> Sudah Bayar Denda </label>
                    <input type="checkbox" name="is_sudah_bayar_denda" id="is_sudah_bayar_denda" value="0"> <br> <span class="text-danger">Jika sudah bayar denda status pengujung tidak diubah</span>
                </div>
                @else
                <div class="form-group">
                    <label for="">Keterangan </label>
                    <input type="text" name="" value="Sudah Bayar Denda" class="form-control" readonly>
                </div>
                @endif
                @if ($data->denda->is_sudah_bayar_denda == '1')
                    <button type="submit" class="btn btn-success">Update Denda</button>
                @endif
            </form>

        </div>
        <div class="col-md-6">
            <h3>Informasi Item</h3>
            <div class="form-group">
                <label for="nama"> Daftar Buku Yang Dipinjam </label>
                @foreach ($data->peminjaman_item as $key => $value )
                    <input type="text" name="nama" value="{{ $value->buku->nama }}" class="form-control" readonly><br>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
@endpush
