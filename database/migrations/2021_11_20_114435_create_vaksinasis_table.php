<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaksinasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksinasi', function (Blueprint $table) {
            $table->increments('id_vaksinasi');
            $table->string('no_sertifikat')->unique();
            $table->unsignedBigInteger('id_user'); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_jenis_vaksin'); 
            $table->foreign('id_jenis_vaksin')->references('id_jenis_vaksin')->on('jenis_vaksin')->onDelete('cascade');
            $table->unsignedInteger('id_tempat_vaksin'); 
            $table->foreign('id_tempat_vaksin')->references('id_tempat_vaksin')->on('tempat_vaksin')->onDelete('cascade');
            $table->unsignedInteger('id_pevaksin'); 
            $table->foreign('id_pevaksin')->references('id_pevaksin')->on('pevaksin')->onDelete('cascade');
            $table->date('tanggal_vaksin');
            $table->enum('vaksinasi_ke', [1, 2]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaksinasi');
    }
}
