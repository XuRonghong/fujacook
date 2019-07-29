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
        if (env('DB_REFRESH')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('parent_id')->comment('父類別')->default(0);
                $table->integer('rank')->comment('序')->default(0);
                $table->string('type', 32)->comment('類')->nullable();
                $table->string('name')->comment('title')->default('未命名標題');
                $table->string('link')->comment('連結')->default('');
                $table->tinyInteger('sub_menu')->comment('是否有子類別')->default(1);
                $table->string('access', 32)->comment('')->nullable();
                $table->tinyInteger('open')->comment('開放')->default(1);
                $table->timestamps();
            });

            Schema::create('admin_menu', function (Blueprint $table) {
                $table->increments('id')->comment('流水編號');
                $table->unsignedInteger('admin_id')->comment('對應admin.id');
                $table->unsignedInteger('menu_id')->comment('對應menus.id');
                $table->tinyInteger('open')->comment('開放')->default(1);
                $table->timestamps();

//            $table->morphs('model');

//            $table->foreign('permission_id')
//                ->references('id')
//                ->on($table_names['permissions'])
//                ->onDelete('cascade');

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
            Schema::dropIfExists('admin_menu');
            Schema::dropIfExists('menus');
        }
    }
}
