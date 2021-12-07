<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->increments('id_profil');
            $table->unsignedBigInteger('id_user'); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('nik')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->date('tanggal_lahir');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil');
    }
}
