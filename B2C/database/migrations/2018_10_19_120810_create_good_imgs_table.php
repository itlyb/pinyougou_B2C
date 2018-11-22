<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_imgs', function (Blueprint $table) {
            $table->unsignedInteger('good_id')->comment('商品id');
            $table->string('img')->comment('图片路径');
            $table->unsignedTinyInteger('type')->comment('图片类型');
            $table->engine="InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_imgs');
    }
}
