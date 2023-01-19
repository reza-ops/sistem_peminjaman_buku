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
        <form action="{{ route('master.pengunjung.store') }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="nama"> Nama <span class="text-danger">*</span> </label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="nama" >
            </div>
            <div class="form-group">
                <label for="alamat"> Alamat <span class="text-danger">*</span> </label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span> </label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" >
            </div>
            <div class="form-group">
                <label for="no_telepon"> No Telepon <span class="text-danger">*</span> </label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="form-control" id="no_telepon" >
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
    $('#tanggal_lahir').flatpickr({
    });
</script>
@endpush
