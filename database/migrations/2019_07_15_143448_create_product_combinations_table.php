<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_REFRESH')) {
            //
            Schema::create('product_combinations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('product_id', 32)->comment('對應products.id');
                $table->string('no', 14)->comment('PC + 上架日期(YYYYMMdd) + 本日商品序號(0000)');
                $table->integer('rank')->comment('順序')->nullable()->default(0);
                $table->string('type', 32)->comment('1: 一般組合商品 2: 限時組合商品 3: 加購組合商品')->default(1);
                $table->unsignedInteger('author_id')->comment('發布者')->default(1);
                $table->string('name', 128)->comment('組合商品別名');
                $table->string('image', 255)->nullable();
                $table->string('file_id')->nullable()->comment('檔案');
                $table->text('detail')->nullable()->comment('產品資訊');
                $table->integer('stars')->nullable()->comment('評價星等');
                $table->integer('review_count')->nullable()->comment('評價數量');
                $table->integer('purchased_count')->nullable()->comment('已購買數量');
                $table->integer('price')->default(0)->comment('特價總和(取最低)');
                $table->integer('market_price')->default(0)->comment('原價總和(取最低price所屬原價)');
                $table->tinyInteger('open')->default(0)->comment('上架狀態');
                $table->timestamps();
            });
            //
            Schema::create('product_items', function (Blueprint $table) {
                $table->increments('id');
                $table->string('product_id', 32)->comment('對應products.id');
                $table->integer('purchase_price')->default(0)->comment('進價');
                $table->integer('cost')->default(0)->comment('成本價');
                $table->integer('price')->default(0)->comment('特價');
                $table->integer('market_price')->default(0)->comment('原價');
                $table->integer('stock')->default(0)->comment('總庫存數量');
                $table->integer('purchased_stock')->default(0)->comment('賣出庫存數量');
                $table->tinyInteger('operator')->default(1)->comment('運算符號 1: 乘(*) 2: 加(+)');
                $table->float('operate_number')->default(0)->comment('運算符號使用數字');
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
            Schema::dropIfExists('product_combinations');
            Schema::dropIfExists('product_items');
        }
    }
}
