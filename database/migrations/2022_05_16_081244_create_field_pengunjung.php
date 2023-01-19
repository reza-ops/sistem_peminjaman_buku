<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldPengunjung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengunjung', function (Blueprint $table) {
            $table->string('no_telepon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengunjung', function($table) {
            $table->dropColumn('penerbit');
            $table->dropColumn('tanggal_terbit');
        });
    }
}
