<div class="col-md-6">
    <div class="form-group">
        <label for="no_transaksi_peminjaman"> No Transaksi </label>
        <input type="text" name="" value="{{ $data->no_transaksi_peminjaman }}" class="form-control" readonly id="no_transaksi_peminjaman" >
    </div>
    <div class="form-group">
        <label for="nama"> Nama Peminjam </label>
        <input type="text" name="" value="{{ $data->pengunjung->nama }}" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Lama Meminjam </label>
        <input type="text" name="" value="{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->diffInDays(\Carbon\Carbon::parse($data->tanggal_kembali)) }} Hari" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Total Tagihan </label>
        <input type="text" name="" value="Rp, {{ number_format($data->total_harga, 2) }} {{ $data->is_sudah_bayar == '0' ? 'Sudah Bayar' : 'Belum Bayar' }}" class="form-control" readonly >
    </div>
    <div class="form-group">
        <label for="nama"> Keterangan </label>
        @if ($data->is_sudah_kembali == '0')
        <textarea class="form-control" readonly> Transaksi Selesai</textarea>
        @else
        <textarea class="form-control" readonly> {{ \Carbon\Carbon::parse($data->tanggal_kembali) < \Carbon\Carbon::now() ? 'Telat Mengembalikan Pengunjung Tidak Bisa Meminjam Sebelum Diupdate Oleh Admin' : '-' }}</textarea>
        @endif
    </div>
    <div class="form-group">
        <label for="nama"> Biaya Lain Lain
            <p  class="text-danger" data-toggle="tooltip" data-placement="top" title="Tagihan Buku Hilang/rusak">
                <i class="fas fa-fw fa-info"></i>
            </p>
        </label>
       <div id="biayaLainlain"></div>
    </div>
    @if ($data->is_sudah_kembali == '0')
        <a class="btn btn-warning bg-back" >Transaksi Sudah Diselesaikan</a>
    @else
        <a class="btn btn-danger bg-back" href="{{ route($route.'selesai_transaksi', ['transaksi_id' => $data->id]) }}">Selesai Transaksi</a>
    @endif
</div>
<div class="col-md-6">
    <label for="nama"> Daftar Buku </label>
    <div id="divListBuku"></div>
    @foreach ($data->peminjaman_item as $item)
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" name="" value="{{ $item->buku->nama }}" class="form-control" readonly >
            </div>
        </div>
        <div class="col-md-4 btnBukuHilang{{ $item->buku_id }}">
            <button class="btn btn-md btn-danger btnBukuHilang "  data-nama-buku="{{ $item->buku->nama }}" data-id-buku="{{ $item->buku->id }}" data-id-transaksi="{{ $data->id }}">Buku Bermasalah ?</button>
        </div>
    </div>

    @endforeach
</div>
<div class="modal fade" id="modalBukuHilang" tabindex="-1" role="dialog" aria-labelledby="modalBukuHilangTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="">Keterangan</label>
              <select class="form-control" name="keterangan" id="keterangan">
                  <option value="rusak">Rusak</option>
                  <option value="hilang">Hilang</option>
              </select>
          </div>
          <div class="form-group">
              <label for="">Denda</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp, </span>
                </div>
                <input type="hidden" name="buku_id" id="bukuId">
                <input type="hidden" name="transaksi_id" id="transaksiId">
                <input type="number" class="form-control" name="denda" id="denda">
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Denda akan ditambahkan ditagihan">
                <i class="fas fa-fw fa-info"></i>
            </button>
          <button type="button" class="btn btn-primary" id="sendBukuRusak">Simpan</button>
        </div>
      </div>
    </div>
  </div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
<script>
    $(document).ready(function(e){

        getBiayaLainLain();
        $('.btnBukuHilang').click(function(){
            var getNamaBuku    = 'Buku '+$(this).data('nama-buku');
            var getIdBuku      = $(this).data('id-buku');
            var getIdTransaksi = $(this).data('id-transaksi');

            $('#modalBukuHilang').modal('show');
            $('#bukuId').val(getIdBuku);
            $('#transaksiId').val(getIdTransaksi);
            $('#modalTitle').text(getNamaBuku);
        });

        $('#sendBukuRusak').click(function(){
            var getIdBuku      = $('#bukuId').val();
            var getIdTransaksi = $('#transaksiId').val();
            var getDenda       = $('#denda').val();
            var getKeterangan  = $('#keterangan').find(":selected").text();

            event.preventDefault();
            $.ajax({
                url:'{{ route($route.'send_denda' )  }}',
                type:"post",
                data:{
                    "_token"      : "{{ csrf_token() }}",
                    "id_buku"     : getIdBuku,
                    "id_transaksi": getIdTransaksi,
                    "denda"       : getDenda,
                    "keterangan"  : getKeterangan,
                },
                success:function(data)
                {
                    if(data.status == true){
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        })
                        $('.btnBukuHilang'+getIdBuku).hide();
                        $('#modalBukuHilang').modal('hide');
                        getBiayaLainLain();
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

        function getBiayaLainLain(){
            var getIdTransaksi = '{{ $data->id }}';
            $.ajax({
                url:'{{ route($route.'get_biaya_lain_lain' )  }}',
                type:"post",
                data:{
                    "_token"      : "{{ csrf_token() }}",
                    "id_transaksi": getIdTransaksi,
                },
                success:function(data)
                {
                    if(data.status == true){
                        var html;

                        html = '<div class="row">' +
                            '<div class="col-lg-12"><h4> Total : Rp, '+data.total+'</h4>';
                        html += '<div class="panel panel-default">';
                            $.each(data.data, function(key, value) {
                                html += '<li class="list-group-item" style="border-width:1px 0px;"> Nama Buku : ' +
                                    value.nama_buku  + ' Rp, ' + value.denda + ' ' + value.keterangan
                                    '</li>';
                            });
                        html += '</div>';
                        html += '</div>' +
                            '</div>';
                        $("#biayaLainlain").html(html);
                        $("#biayaLainlain").html(html);
                        $.each(data.data, function(key, value) {
                            $(".btnBukuHilang"+value.buku_id).hide();
                        });
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: data.message,
                        })
                    }
                }
            })
        }

    })
</script>
