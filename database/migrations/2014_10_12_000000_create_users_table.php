<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->unsignedInteger('role');
            $table->foreign('role')->references('id_role')->on('role')->onDelete('cascade');
        });

        $userData = array(
            [
                'email' => '18650045@student.uin-malang.ac.id',
                'role' => '1',
            ],
        );

        foreach ($userData as $data){
            $user = new User();
            $user->email =$data['email'];
            $user->role =$data['role'];
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
