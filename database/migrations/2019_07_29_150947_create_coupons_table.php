<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
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
            Schema::create('coupons', function (Blueprint $table) {
                $table->increments('id');
                $table->text('value');
                $table->string('type', 32)->comment('1:輸入序號打折 2:輸入序號折現金 3:首次購物折現金');
                $table->string('code')->nullable()->comment('優惠序號');
                $table->double('discount_percentage')->nullable()->comment('打折百分比');
                $table->integer('limit')->nullable()->comment('限量');
                $table->integer('discount_price')->nullable()->comment('現金折扣金額');
                $table->boolean('is_limit')->default(0)->comment('是否限量');
                $table->boolean('is_time_limit')->default(0)->comment('是否限時');
                $table->boolean('status')->default(1)->comment('優惠券狀態 0:停用 1:啟用');
                $table->dateTime('start_at')->nullable()->comment('限時(開始時間)');
                $table->dateTime('end_at')->nullable()->comment('限時(結束時間)');
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
            //
            Schema::dropIfExists('coupons');
        }
    }
}
