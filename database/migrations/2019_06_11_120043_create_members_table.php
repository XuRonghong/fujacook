<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no', 13)->comment('會員編號:m+time()');
            $table->integer('rank')->comment('順序')->nullable()->default(0);
            $table->string('type', 32)->comment('類')->nullable();
            $table->string('name')->comment('會員名稱');
            $table->string('email')->nullable();
            $table->string('account');
            $table->string('password');
            $table->string('createIP')->comment('註冊的網路位置');
            $table->tinyInteger('active')->comment('啟用')->default(0);
            $table->string('code')->comment('代號')->nullable();
            $table->rememberToken()->nullable();
            $table->string('api_token', 64)->nullable()->unique();
            $table->string('avatar')->nullable()->comment('會員大頭貼');
            $table->string('gender', 10)->nullable();
            $table->string('designation')->nullable()->comment('稱號');
            $table->integer('age')->nullable();
            $table->string('file_id')->nullable()->comment('檔案');
            $table->string('phone', 32)->nullable()->comment('電話');
            $table->string('nation', 64)->nullable()->comment('國家');
            $table->string('county', 128)->nullable()->comment('縣市');
            $table->string('district', 128)->nullable()->comment('區');
            $table->string('address')->nullable()->comment('地址');
            $table->integer('bonus')->default(0)->comment('購物金');
            $table->boolean('confirm_terms')->default(0)->comment('同意會員條款/隱私權政策');
            $table->dateTime('login_time')->nullable()->comment('最後登入時間');
            $table->timestamps();
        });

        // 會員常用聯絡資訊
        Schema::create('member_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('對應members.id');
            $table->string('name')->nullable()->comment('名稱');
            $table->string('email')->nullable()->comment('電子信箱');
            $table->string('phone')->nullable()->comment('電話');
            $table->string('county')->nullable()->comment('縣市');
            $table->string('district')->nullable()->comment('區');
            $table->string('address')->nullable()->comment('地址');
            $table->timestamps();

//            $table->foreign('member_id')
//                ->references('id')
//                ->on('members')
//                ->onDelete('cascade');
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
        Schema::dropIfExists('member_contacts');
        Schema::dropIfExists('members');
    }
}
