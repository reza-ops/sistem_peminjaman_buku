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
        <form action="{{ route('master.buku.store') }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="nama"> Nama <span class="text-danger">*</span> </label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="nama" >
            </div>
            <div class="form-group">
                <label for="">Categori</label>
                <select name="kategori_id" id="" class="form-control">
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="biaya_per_hari"> Biaya Per Hari <span class="text-danger">*</span> </label>
                <input type="number" name="biaya_per_hari" value="{{ old('biaya_per_hari') }}" class="form-control" id="biaya_per_hari" >
            </div>
            <div class="form-group">
                <label for="penerbit"> Penerbit <span class="text-danger">*</span> </label>
                <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="form-control" id="penerbit" >
            </div>
            <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit <span class="text-danger">*</span> </label>
                <input type="text" name="tanggal_terbit" value="{{ old('tanggal_terbit') }}" class="form-control" id="tanggal_terbit" >
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a class="btn btn-default bg-back" href="{{ route($route.'index') }}">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $('#tanggal_terbit').flatpickr({
        dateFormat: "Y-m-d"
    });
</script>
@endpush
