<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('user_carts', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('good_id')->comment('商品id');
            $table->unsignedInteger('good_num')->comment('商品数量');
            $table->decimal('money', 10, 2)->default(0)->comment('消费金额');
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
        Schema::dropIfExists('user_carts');
    }
}
