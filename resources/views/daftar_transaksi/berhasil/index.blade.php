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

                    </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center border w-100"  id="data-table">
                <thead class="thead-light">
                    <tr>
                        <th width="5%" scope="col">No</th>
                        <th scope="col">NO Transaksi</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
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
        var url_ajax = '{!! URL::to('daftar_transaksi/berhasil/get_data') !!}';
        var column = [
                        { data: 'DT_RowIndex', searchable: false, orderable: false, className: 'dt-center' },
                        { data: 'no_transaksi_peminjaman', name: 'no_transaksi_peminjaman' },
                        { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                        { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                        { data: 'aksi', name: 'aksi' },
                ];
        global.init_datatable(id_datatable, url_ajax, column);
    });
</script>
@endpush
