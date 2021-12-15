<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Profil;

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

        $profilData = array(
            [
                'id_user' => '1',
                'nik' => '3523160804990002',
                'nama' => 'Admin',
                'alamat' => 'Malang',
                'tanggal_lahir' => '19990408'
            ],
            [
                'id_user' => '2',
                'nik' => '3523160804990004',
                'nama' => 'Arif',
                'alamat' => 'Tuban',
                'tanggal_lahir' => '19990408'
            ],
        );

        foreach ($profilData as $data){
            $profil = new Profil();
            $profil->id_user =$data['id_user'];
            $profil->nik =$data['nik'];
            $profil->nama =$data['nama'];
            $profil->alamat =$data['alamat'];
            $profil->tanggal_lahir =$data['tanggal_lahir'];
            $profil->save();
        }
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
