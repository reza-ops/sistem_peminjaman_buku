@extends('layouts.app')
@section('content')

<div class="card shadow mt-2">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-0">{{ $header }}</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('rekap_transaksi.terlambat.store') }}"  target="_blank" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="tanggal_awal"> Tanggal Awal <span class="text-danger">*</span> </label>
                <input type="date" name="tanggal_awal" value="{{ old('tanggal_awal') }}" class="form-control" id="tanggal_awal" >
            </div>
            <div class="form-group">
                <label for="tanggal_akhir"> Tanggal Akhir <span class="text-danger">*</span> </label>
                <input type="date" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" class="form-control" id="tanggal_akhir" >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Download Excel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
@endpush
