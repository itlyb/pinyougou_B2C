<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_attrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('搜索属性名称');
            $table->string('type_name')->comment('属性类别');
            $table->string('tags')->comment('标签');
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
        Schema::dropIfExists('search_attrs');
    }
}
