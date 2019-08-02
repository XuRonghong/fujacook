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
            // 訂單
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
            // 訂單詳情
            Schema::create('order_details', function (Blueprint $table) {
                $table->increments('id');
                $table->string('no', 14)->nullable();
                $table->unsignedInteger('order_id')->comment('對應orders.id');
                $table->unsignedInteger('product_id')->comment('對應products.id');
                $table->unsignedInteger('ownerKey')->nullable()->comment('對應id');
                $table->string('related')->nullable()->comment('對應table');
                $table->string('type', 32)->nullable()->comment('0:正常訂購 1:追加數量 2:減少數量 3:補繳 4:退費');
                $table->integer('purchase_price')->default(0)->comment('進價');
                $table->integer('cost_price')->default(0)->comment('成本價');
                $table->integer('price')->default(0)->comment('價');
                $table->integer('market_price')->default(0)->comment('原價');
                $table->integer('quantity')->default(0)->comment('購買數量');
                $table->smallInteger('status')->nullable()->comment('0:未處理 1:已確認 2:已取消 3:已折讓');
                $table->timestamps();
            });
            // 訂單聯絡資訊
            Schema::create('order_contacts', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('order_id')->comment('對應orders.id');
                $table->string('no', 14)->nullable();
                $table->string('type', 32)->nullable()->comment('訂單聯絡人類型 1:訂購人資料 2:收件人資料');
                $table->string('name', 64)->nullable()->comment('訂單聯絡人名稱');
                $table->string('gender', 4)->nullable()->comment('訂單聯絡人性別');
                $table->string('email', 128)->nullable()->comment('電子信箱');
                $table->string('phone', 32)->nullable()->comment('訂單聯絡人電話');
                $table->string('zip_code', 32)->nullable()->comment('郵政編碼');
                $table->string('county', 64)->nullable()->comment('縣市');
                $table->string('district', 64)->nullable()->comment('區');
                $table->string('address', 255)->nullable()->comment('地址');
                $table->string('tax_ID', 32)->nullable()->comment('統一編號');
                $table->string('remarks', 128)->nullable()->comment('備註');
                $table->timestamps();
            });
            // 訂單發票
            Schema::create('order_invoices', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('order_id')->comment('對應orders.id');
                $table->string('no', 14)->nullable();
                $table->integer('TotalAmt')->nullable();
                $table->string('MerchantID')->nullable();
                $table->string('InvoiceTransNo')->nullable();
                $table->string('MerchantOrderNo')->nullable();
                $table->string('InvoiceNumber')->nullable();
                $table->string('RandomNum')->nullable();
                $table->string('CheckCode')->nullable();
                $table->string('BarCode')->nullable();
                $table->string('QRcodeL')->nullable();
                $table->string('QRcodeR')->nullable();
                $table->string('invoice_number')->nullable()->comment('發票號碼');
                $table->string('company_invoice_url')->nullable()->comment('公司發票網址');
                $table->string('customer_invoice_url')->nullable()->comment('客戶發票網址');
                $table->tinyInteger('status')->nullable();
                $table->timestamps();
            });
            // 訂單優惠券 對應
            Schema::create('coupon_order', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('coupon_id')->comment('對應coupons.id');
                $table->unsignedInteger('order_id')->comment('對應orders.id');
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
            Schema::dropIfExists('coupon_order');
            Schema::dropIfExists('order_invoices');
            Schema::dropIfExists('order_contacts');
            Schema::dropIfExists('order_details');
            Schema::dropIfExists('orders');
        }
    }
}
