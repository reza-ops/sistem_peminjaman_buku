@extends('layouts.app')
@section('content')
<div class="">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="m-0 font-weight-bold text-dark">{{ $header }}</h3>
                </div>
                    <div class="col text-right">
                        <a href="{{ route($route. 'create') }}" class="btn btn-success">Tambah</a>
                    </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center border w-100"  id="data-table">
                <thead class="thead-light">
                    <tr>
                        <th width="5%" scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga Per Hari</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>
{{-- end pattern- --}}

@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
      $(document).ready(function () {
        var id_datatable = "#data-table";
        var url_ajax = '{!! URL::to('master/buku/get_data') !!}';
        var column = [
                        { data: 'DT_RowIndex', searchable: false, orderable: false, className: 'dt-center' },
                        { data: 'nama', name: 'nama' },
                        { data: 'biaya', name: 'biaya_per_hari' },
                        { data: 'keterangan', name: 'keterangan' },
                        { data: 'kode_buku', name: 'kode_buku' },
                        { data: 'aksi', name: 'aksi' },
                ];
        global.init_datatable(id_datatable, url_ajax, column);
    });
</script>
@endpush
