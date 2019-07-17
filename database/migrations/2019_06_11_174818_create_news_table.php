<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_REFRESH')) {
        }
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank')->comment('順序')->nullable()->default(0);
            $table->string('type')->comment('類')->nullable();
            $table->integer('author_id')->comment('發布者')->default(1);
            $table->string('title', 127)->nullable();
            $table->string('summary', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('file_id')->nullable()->comment('檔案');
            $table->string('url', 255)->comment('相關連結')->nullable();
            $table->longText('detail')->nullable();
            $table->integer('click')->comment('點擊')->default(0);
            $table->string('status')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->tinyInteger('open')->default(0);
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
        if (env('DB_REFRESH')) {
        }
        Schema::dropIfExists('news');
    }
}
