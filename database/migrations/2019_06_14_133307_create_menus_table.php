<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->common('父類別')->default(0);
            $table->integer('rank')->common('序')->default(0);
            $table->string('type')->common('類')->nullable();
            $table->string('name')->common('title')->default('未命名標題');
            $table->string('link')->common('連結')->default('');
            $table->tinyInteger('sub_menu')->common('是否有子類別')->default(1);
            $table->string('access')->common('')->nullable();
            $table->tinyInteger('open')->common('開放')->default(1);
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
        Schema::dropIfExists('menus');
    }
}
