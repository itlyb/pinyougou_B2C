<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->string('little_name')->comment('副标题');
            $table->unsignedInteger('type_id')->comment('类别id');
            $table->unsignedInteger('type_pid')->comment('父id');
            $table->unsignedInteger('brand_id')->comment('品牌id');
            $table->unsignedTinyInteger('is_shelf')->default(0)->comment('是否上架');
            $table->unsignedTinyInteger('state')->default(0)->comment('状态');
            $table->unsignedInteger('good_num')->default(0)->comment('商品数量');
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
        Schema::dropIfExists('goods');
    }
}
