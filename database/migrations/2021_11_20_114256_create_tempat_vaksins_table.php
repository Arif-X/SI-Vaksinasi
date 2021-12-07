<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatVaksinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_vaksin', function (Blueprint $table) {
            $table->increments('id_tempat_vaksin');
            $table->string('nama_tempat');
            $table->text('alamat');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_vaksin');
    }
}
