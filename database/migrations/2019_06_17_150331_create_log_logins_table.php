<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->common('登入者id')->nullable();
            $table->string('user_type')->common('登入者類')->nullable();
            $table->string('action')->common('操作紀錄')->nullable();
            $table->string('ip')->common('IP位置')->nullable();
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
        Schema::dropIfExists('log_logins');
    }
}
