<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSpecsTable extends Migration
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
        //規格
        Schema::create( 'product_specs', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger('product_id')->comment('對應products.id');
            $table->string( 'spec_num')->nullable();
            $table->string('name')->comment('商品規格名稱');
            $table->string( 'spec_unit' )->nullable()->comment('單位: 件 組 個');
            $table->integer( 'spec_price' )->default( 0 );
            $table->integer( 'spec_stock' )->default( 0 );
            $table->integer( 'spec_safe_stock' )->default( 0 );
            $table->string('image')->nullable();
            $table->string('file_id')->nullable()->comment('檔案');
            $table->tinyInteger('status')->default(0)->comment('狀態');
            $table->tinyInteger('open')->default(0)->comment('上架狀態');
            $table->timestamps();
        } );
        //商品規格
//        Schema::create('product_specs', function (Blueprint $table) {
//            $table->increments('id');
//            $table->unsignedInteger('product_id')->comment('對應products.id');
//            $table->unsignedInteger('spec_id')->comment('對應specifications.id');
//            $table->string('name')->comment('商品規格名稱');
//            $table->timestamps();
//        });
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
        Schema::dropIfExists('product_specs');
//        Schema::dropIfExists('specifications');
    }
}
