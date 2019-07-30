<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('no', 14)->comment('GP + 上架日期(YYYYMMdd) + 本日商品序號(0000)');
                $table->integer('rank')->comment('順序')->nullable()->default(0);
                $table->string('type', 32)->comment('類')->nullable();
                $table->unsignedInteger('author_id')->comment('發布者')->default(1);
                $table->unsignedInteger('store_id' )->nullable()->default( 0 );
                $table->string('name')->comment('商品名');
                $table->integer('price' )->default( 100 );
                $table->string( 'num', 255)->nullable()->comment('型號'); //
                $table->string('code', 255)->nullable()->comment('系統識別碼');
                $table->string('image', 255)->nullable();
                $table->string('file_id')->nullable()->comment('檔案');
                $table->text('spec_note')->nullable()->comment('規格清單');
                $table->text('product_description')->nullable()->comment('產品資訊');
                $table->text('service_description')->nullable()->comment('配送及售後服務說明');
                $table->text('other_description')->nullable()->comment('其他說明');
                $table->tinyInteger('status')->default(0)->comment('狀態');
                $table->tinyInteger('open')->default(0)->comment('上架狀態');
                $table->timestamps();
            });
            //
            Schema::create('product_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger( 'parent_id')->default(0);
                $table->integer('rank')->comment('順序')->nullable()->default(0);
                $table->string('type', 32)->comment('類')->nullable();
                $table->unsignedInteger('author_id')->comment('發布者')->default(1);
                $table->unsignedInteger('store_id' )->nullable()->default( 0 );
                $table->string('name')->comment('商品類別名稱');
                $table->string( 'value', 128)->nullable();
                $table->integer( 'number' )->nullable();
                $table->string('image')->nullable();
                $table->string('file_id')->nullable()->comment('檔案');
                $table->tinyInteger('status')->default(0)->comment('狀態');
                $table->tinyInteger('open')->default(0)->comment('上架狀態');
                $table->timestamps();
            });
            //
            Schema::create('payment_methods', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 64)->comment('付款方式名稱');
                $table->boolean('status')->default(1)->comment('啟用狀態');
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
            Schema::dropIfExists('products');
            Schema::dropIfExists('product_categories');
            Schema::dropIfExists('payment_methods');
        }
    }
}
