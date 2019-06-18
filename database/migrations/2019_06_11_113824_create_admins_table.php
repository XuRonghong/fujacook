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
            $table->string('no', 14)->comment('管理者編號:a + auth()->id + time()');
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

        Schema::create('admins_info', function (Blueprint $table) {
            $table->integer( 'admin_id' )->unique();
            $table->string( 'user_file')->nullable();
            $table->string( 'user_image')->nullable();
            $table->string( 'user_name')->nullable();
            $table->string( 'user_name_en')->nullable();
            $table->string( 'user_title')->nullable();
            $table->string( 'userID')->nullable();
            $table->dateTime( 'user_birthday' )->nullable();
            $table->string( 'user_email')->nullable();
            $table->string( 'user_contact')->nullable();
            $table->string( 'user_zip_code')->nullable();
            $table->string( 'user_city')->nullable();
            $table->string( 'user_area')->nullable();
            $table->string( 'user_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_info');
        Schema::dropIfExists('admins');
    }
}
