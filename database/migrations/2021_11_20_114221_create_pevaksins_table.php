<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Pevaksin;

class CreatePevaksinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pevaksin', function (Blueprint $table) {
            $table->increments('id_pevaksin');
            $table->unsignedBigInteger('id_user'); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        $pevaksinData = array(
            [
                'id_user' => '1',
            ],
        );

        foreach ($pevaksinData as $data){
            $pevaksin = new Pevaksin();
            $pevaksin->id_user =$data['id_user'];
            $pevaksin->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pevaksin');
    }
}
