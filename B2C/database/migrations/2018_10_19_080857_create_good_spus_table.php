<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodSpusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('good_spus', function (Blueprint $table) {
            $table->unsignedInteger('good_id')->comment('商品id');
            $table->string('path')->comment('路径');
            $table->decimal('price', 10, 2)->comment('单品价格');
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
        Schema::dropIfExists('good_spus');
    }
}
