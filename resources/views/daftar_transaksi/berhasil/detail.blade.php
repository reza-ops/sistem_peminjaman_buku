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
