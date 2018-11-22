<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeckillGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('seckill_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('good_id')->comment('商品id');
            $table->decimal('price', 10, 2)->comment('价格');
            $table->unsignedInteger('num')->comment('商品数量');
            $table->unsignedInteger('type')->comment('类型id');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seckill_goods');
    }
}
