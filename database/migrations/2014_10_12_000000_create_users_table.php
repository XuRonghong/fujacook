<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //忘記密碼寄驗證信
        Schema::create('user_verification', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'user_id' )->common('admin_id,member_id','user_id');
            $table->string( 'user_table' )->common('admins,members','users');
            $table->string( 'verification', 50);
            $table->dateTime( 'start_time' );
            $table->dateTime( 'end_time' );
            $table->tinyInteger( 'status' )->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification');
        Schema::dropIfExists('users');
    }
}
