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
        Schema::create('scenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'author_id' )->nullable()->comment('創建者');
            $table->integer( 'rank' )->nullable()->comment('序');
            $table->integer( 'category' )->nullable()->comment('類');
            $table->string( 'type' )->nullable()->comment('型');
            $table->string( 'title' )->nullable()->comment('標題');
            $table->string( 'summary' )->nullable()->comment('簡介');
            $table->string( 'detail' )->nullable()->comment('詳細');
            $table->string( 'lang' )->nullable()->comment('語言');
            $table->integer( 'file_id' )->nullable()->comment('檔案');
            $table->string( 'image' )->nullable()->comment('圖片');
            $table->string( 'image_mobile' )->nullable()->comment('手機圖片');
            $table->string( 'url' )->nullable()->comment('連結');
            $table->string( 'style' )->nullable()->comment('風格樣式');
            $table->dateTime( 'start_time' )->default('')->comment('開始時間');
            $table->dateTime( 'end_time' )->default('')->comment('結束時間');
            $table->tinyInteger('open')->default( 0 );
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
        Schema::dropIfExists('scenes');
    }
}
