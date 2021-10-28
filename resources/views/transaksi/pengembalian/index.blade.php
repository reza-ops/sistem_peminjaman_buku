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
                    <label for="no_transaksi"> Masukan No Transaksi </label>
                    <input type="text" name="no_transaksi" value="{{ old('no_transaksi') }}" class="form-control" id="inputNoTransaksi" >
                </div>
                <div class="col-md-1 pl-0">
                    <button type="submit" class="btn btn-success" style="margin-top: 30px" id="btnFilter">Cari</button>
                </div>
                <div class="col-md-12 showTransaksi row" ></div>
            </div>
            <div class="col-md-6">
                <br>
            </div>
        </div>
    </div>


</div>
@endsection
@push('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btnFilter').click(function(e){
            var getInputText = $('#inputNoTransaksi').val();

            event.preventDefault();
            $.ajax({
                url:'{{ route($route.'search_no_transaksi' )  }}',
                type:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "kode":getInputText
                },
                success:function(data)
                {
                    $('.showTransaksi').html(data.html);
                    listTransaksi();
                }
            })
        });
    })
</script>

@endpush
