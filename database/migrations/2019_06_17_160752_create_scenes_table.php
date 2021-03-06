<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_REFRESH')) {
            Schema::create('scenes', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('author_id')->nullable()->comment('創建者');
                $table->integer('rank')->nullable()->comment('序')->default(0);
                $table->integer('category')->nullable()->comment('類');
                $table->string('type', 32)->nullable()->comment('型');
                $table->string('title', 64)->nullable()->comment('標題');
                $table->string('summary', 128)->nullable()->comment('簡介');
                $table->longText('detail')->nullable()->comment('內容');
                $table->string('lang', 32)->nullable()->comment('語言');
                $table->integer('file_id')->nullable()->comment('檔案');
                $table->string('image')->nullable()->comment('圖片');
                $table->string('image_mobile')->nullable()->comment('手機圖片');
                $table->string('url')->nullable()->comment('連結');
                $table->string('style', 128)->nullable()->comment('風格樣式');
                $table->dateTime('start_time')->nullable()->comment('開始時間');
                $table->dateTime('end_time')->nullable()->comment('結束時間');
                $table->tinyInteger('open')->default(0);
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
            Schema::dropIfExists('scenes');
        }
    }
}
