<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
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
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->nullable()->comment('創建者');
            $table->integer('rank')->nullable()->comment('序');
            $table->integer('category')->default(1)->comment('類');
            $table->string('type')->nullable()->comment('型');
            $table->string('name')->default('未命名參數')->comment('系統參數名稱');
            $table->longText('content')->nullable()->comment('系統參數內容');
            $table->string('value')->nullable()->comment('值');
            $table->integer( 'count' )->default(0)->comment('計數');
            $table->string('lang')->nullable()->comment('語言');
            $table->string('url')->nullable()->comment('連結');
            $table->string('style')->nullable()->comment('風格樣式');
            $table->string('image')->nullable()->comment('圖片');
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
        Schema::dropIfExists('settings');
    }
}
