<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');

            $table->string('serial_number'); //發文 號
            $table->uuid('serial_id'); //發文 字
            $table->dateTime('date'); //發文日期
            $table->uuid('receiver'); //受文者
            $table->string('speed'); //速別
            $table->string('confidentiality'); //密等

            $table->string('subject'); //主旨
            $table->longText('explanation'); //說明

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
        Schema::dropIfExists('docs');
    }
}
