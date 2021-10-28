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
        <div class="row">
            <div class="col-md-12 row">
                <div class="form-group col-md-11">
                    <label for="nama"> Masukan Kode Buku </label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="inputKodeBuku" >
                </div>
                <div class="col-md-1 pl-0">
                    <button type="submit" class="btn btn-success" style="margin-top: 30px" id="btnFilter">Cari</button>
                </div>
                <div class="col-md-12 showBuku row" ></div>
            </div>
            <div class="col-md-6">
                <br>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <h4 class="text-bold" for="daftar_buku">Informasi Peminjam</h4>
                    <div class="form-group">
                        <label for="nama"> Peminjam </label>
                        <select data-route="{{route($route.'select_pengunjung') }}" id="pengunjung_id" class="select-pengunjung form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam"> Tanggal Pinjam </label>
                        <input type="date" id="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" class="form-control" id="tanggal_pinjam" >
                    </div>
                    <div class="form-group">
                        <label for="tanggal_dikembalikan"> Tanggal Dikembalikan </label>
                        <input type="date" id="tanggal_dikembalikan" value="{{ old('tanggal_dikembalikan') }}" class="form-control" id="tanggal_dikembalikan" >
                    </div>
                    <div class="form-group">
                        <label for="is_sudah_bayar"> Sudah Bayar </label>
                        <input type="checkbox" id="is_sudah_bayar" id="is_sudah_bayar" value="0">
                    </div>

                    <button type="submit" class="btn btn-info" id="btnBuatTransaksi">Buat Transaksi</button>
                </div>
            </div>
            <div class="col-md-6 row">
                <div class="form-group col-md-12">
                    <h4 class="text-bold" for="daftar_buku"> Daftar Buku Yang Dipinjam</h4>
                    <div id="divDaftarBuku"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('/js/select2.min.js') }}"></script>
<script>

    var ischecked = 0;
    var getlastidbuku = {};
    $(document).ready(function(){

        $('#btnFilter').click(function(e){
            var getInputText = $('#inputKodeBuku').val();

            event.preventDefault();
            $.ajax({
                url:'{{ route($route.'search_kode_buku' )  }}',
                type:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "kode":getInputText
                },
                success:function(data)
                {
                    $('.showBuku').html(data.html);
                    listBuku();
                }
            })
        });

        function listBuku(){
            $('#btnTambahKeranjang').click(function(e){

                e.preventDefault();

                var getIdBuku = $(this).data('id');
                var getNamaBuku = $(this).data('nama');

                $("#divDaftarBuku").append('<div  class="form-group row div'+getIdBuku+'"><div  class="col-md-8"><input type="text" value="'+getNamaBuku+'" class="form-control" readonly><input type="hidden" id="buku_id" name="list_buku" value="'+getIdBuku+'" ></div><div  class="col-md-4"><button type="submit" class="btn btn-danger btnHapusBuku" data-id="'+getIdBuku+'">Hapus Buku</button></div>');
            });
        }
        $('#divDaftarBuku').on('click', '.btnHapusBuku', function(e) {
            e.preventDefault();

            var getId = $(this).data('id');


            $('.div'+getId).remove()
        });
    });

    $('#btnBuatTransaksi').click(function(e){
            var pengunjung      = $('#pengunjung_id').val();
            var tanggal_pinjam  = $('#tanggal_pinjam').val();
            var tanggal_kembali = $('#tanggal_dikembalikan').val();
            var buku_id         = $('input[name^=list_buku]').map(function(idx, elem) {return $(elem).val();}).get();
            var sudah_bayar = '1';

            if (document.getElementById('is_sudah_bayar').checked) {
                sudah_bayar     = '0'
            } else {
               sudah_bayar = '1'
            }


            event.preventDefault();
            $.ajax({
                url:'{{ route($route.'store' )  }}',
                type:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "pengunjung":pengunjung,
                    "tanggal_pinjam":tanggal_pinjam,
                    "tanggal_kembali":tanggal_kembali,
                    "sudah_bayar":sudah_bayar,
                    "buku_id":buku_id,
                },
                success:function(data)
                {
                    if(data.status == true){
                        var url = data.url_finish_transaksi;
                        window.location = url;
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: data.message,
                        })
                    }
                }

            })
        });


</script>
<script>
    var nama_route = 'route'
    var id = '.select-pengunjung';
    var route = $(id).data(nama_route);
    $('.select-pengunjung').select2({
        placeholder: "Pilih Pengunjung",
        ajax: {
                url: route,
                dataType: 'json',
                data: function (params) {
                            return {
                            nama: $.trim(params.term),
                            not_in : $(this).val(),
                            };
                        },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
    });
</script>
@endpush
