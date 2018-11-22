<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('good_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品类别名称');
            $table->unsignedInteger('pid')->comment('父级id');
            $table->string('path')->comment('路径');
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
        Schema::dropIfExists('good_types');
    }
}
