<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no', 13)->comment('管理者編號:a+time()');
            $table->integer('rank' )->comment('順序')->nullable();
            $table->integer('type' )->comment('類')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('account');
            $table->string('password');
            $table->string('createIP')->comment('註冊的網路位置');
            $table->tinyInteger('active')->comment('啟用')->default( 0 );
            $table->rememberToken();
            $table->dateTime('login_time')->comment('最後登入時間')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
