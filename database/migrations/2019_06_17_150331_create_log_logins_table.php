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
        if (env('DB_REFRESH')) {
            //紀錄登入
            Schema::create('log_logins', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->comment('登入者id')->nullable();
                $table->string('user_type')->comment('登入者類')->nullable();
                $table->string('action')->comment('操作紀錄')->nullable();
                $table->string('ip')->comment('IP位置')->nullable();
                $table->timestamps();
            });

            //紀錄操作動作
            Schema::create('log_actions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->comment('登入者id')->nullable();
                $table->string('user_type')->comment('登入者類')->nullable();
                $table->string('table_id')->comment('表id')->nullable();
                $table->string('table_name')->comment('表名稱')->nullable();
                $table->string('action')->comment('操作紀錄')->nullable();
                $table->longText('value')->comment('值')->nullable();
                $table->string('ip')->comment('IP位置')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env('DB_REFRESH')) {
            Schema::dropIfExists('log_actions');
            Schema::dropIfExists('log_logins');
        }
    }
}
