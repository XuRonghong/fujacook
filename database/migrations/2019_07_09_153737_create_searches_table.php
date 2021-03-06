<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_REFRESH')) {
            Schema::create('searches', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('author_id')->nullable()->comment('創建者');
                $table->integer('rank')->nullable()->comment('序')->default(0);
                $table->integer('category')->default(1)->comment('類');
                $table->string('type', 32)->nullable()->comment('型');
                $table->string('name')->default('未命名參數')->comment('系統參數名稱');
                $table->longText('content')->nullable()->comment('系統參數內容');
                $table->string('value', 64)->nullable()->comment('值');
                $table->integer('count')->default(0)->comment('計數');
                $table->string('lang', 32)->nullable()->comment('語言');
                $table->string('url')->nullable()->comment('連結');
                $table->string('style', 128)->nullable()->comment('風格樣式');
                $table->string('image')->nullable()->comment('圖片');
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
            Schema::dropIfExists('searches');
        }
    }
}
