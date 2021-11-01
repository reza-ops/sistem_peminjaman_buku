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
        <form action="{{ route('profile.update', Auth::user()->id) }}" class="form-global-handle" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name"> Nama <span class="text-danger">*</span> </label>
                <input type="text" name="name" value="{{ $data->name }}" class="form-control" id="name" >
            </div>
            <div class="form-group">
                <label for="email"> Email <span class="text-danger">*</span> </label>
                <input type="email" name="email" value="{{ $data->email }}" class="form-control" id="email" >
            </div>
            <div class="form-group">
                <label for="password"> Password  </label>
                <input type="password" name="password" class="form-control" id="password" >
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
