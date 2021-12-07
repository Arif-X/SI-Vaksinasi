<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Role;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id_role');
            $table->string('nama_role');
        });

        $roleData = array(
            [
                'nama_role' => 'Admin',
            ],
            [
                'nama_role' => 'Pevaksin',
            ],
            [
                'nama_role' => 'Peserta Vaksinsasi',
            ],
        );

        foreach ($roleData as $data){
            $roles = new Role();
            $roles->nama_role =$data['nama_role'];
            $roles->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
