<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('DB_REFRESH')) {
            Schema::create('files', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('rank')->nullable();
                $table->integer('author_id')->nullable();
                $table->smallInteger('type')->default(0)->common('1.S3原檔 2.local原檔 3.S3裁切 4.local裁切');
                $table->string('file_type')->common('附檔名')->nullable();
                $table->string('file_server')->common('APP_URL')->nullable();
                $table->string('file_path')->common('')->nullable();
                $table->string('file_name')->common('');
                $table->integer('file_size')->common('')->nullable();
                $table->tinyInteger('open')->default(1);
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
            Schema::dropIfExists('files');
        }
    }
}
