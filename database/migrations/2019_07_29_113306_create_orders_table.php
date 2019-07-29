<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
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
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no', 14)->comment('OR + 上架日期(YYYYMMdd) + 商品序號(0000)');
            $table->string('type', 32)->nullable()->comment('類');
            $table->unsignedInteger('store_id')->comment('對應store.id');
            $table->unsignedInteger('member_id')->comment('對應members.id');
            $table->integer('total_price')->default(0)->comment('訂單總金額');
            $table->integer('shipping_fee')->default(0)->comment('運費');
            $table->integer('promo_fee')->default(0)->comment('折扣');
            $table->integer('bonus')->default(0)->comment('使用購物金數量');
            $table->string('payment_method_id', 32)->nullable()->comment('付款方式');
            $table->string('bank_last_no', 5)->nullable()->comment('匯款款帳號後五碼');
            $table->tinyInteger('shipping_type')->default(1)->comment('物流方式 1:自取 2:黑貓寄送');
            $table->tinyInteger('shipping_status')->default(1)->comment('出貨狀態 1:未出貨 2:出貨中 3:已出貨');
            $table->tinyInteger('pay_status')->default(1)->comment('訂單狀態 1:未付款 2:已付款 3:已取消授權 4:已請款 8:退貨 9:付款失敗 0:取消');
            $table->dateTime('paid_at')->nullable()->comment('收款時間');
            $table->string('shipping_note')->nullable()->comment('運送備註');
            $table->string('pay_note')->nullable()->comment('訂單備註');
            $table->text('customerservice_note')->nullable()->comment('客服備註');
            $table->string('status', 32)->nullable()->default(0);
            $table->timestamps();
        });
        //
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('對應orders.id');
            $table->string('type')->nullable()->comment('類');
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
            //
        }
        Schema::dropIfExists('orders');
    }
}
