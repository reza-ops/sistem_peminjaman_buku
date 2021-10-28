<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('pengunjung_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->integer('is_sudah_bayar');
            $table->integer('is_sudah_kembali');
            $table->integer('is_terlambat_kembali');
            $table->string('no_transaksi_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
