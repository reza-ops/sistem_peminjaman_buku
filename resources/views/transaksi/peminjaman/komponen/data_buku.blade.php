<div class="col-md-6">
    <div class="form-group">
        <label for="nama"> Nama Buku </label>
        <input type="text" name="" value="{{ $data->nama }}" class="form-control" readonly id="namaBuku" >
    </div>
    <div class="form-group">
        <label for="nama"> Kategori </label>
        <input type="text" name="" value="{{ $data->kategori->nama }}" class="form-control" readonly >
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="nama"> Biaya Per Hari </label>
        <input type="text" name="" value="Rp, {{ number_format($data->biaya_per_hari, 2) }}" class="form-control" readonly >
    </div>
    <div class="form-group">
        @if ($data->is_stock == '1')
            <button type="submit" class="btn btn-danger" style="margin-top: 30px"  data-id="{{ $data->id }}" data-nama="{{ $data->nama }}" >Buku Masih Di Pinjam</button>
        @else
            <button type="submit" class="btn btn-warning" style="margin-top: 30px" id="btnTambahKeranjang" data-id="{{ $data->id }}" data-nama="{{ $data->nama }}" >Tambah Ke Keranjang</button>
        @endif
    </div>
</div>
