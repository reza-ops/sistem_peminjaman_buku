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

        <form action="{{ route('master.kategori.store') }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="nama"> Nama <span class="text-danger">*</span> </label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="nama" >
            </div>
            <div class="form-group">
                <label for="deskripsi"> Deskripsi <span class="text-danger">*</span> </label>
                <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" class="form-control" id="deskripsi" >
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
@endpush
