<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('article_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('文章类型名称');
            $table->unsignedInteger('pid')->comment('父id');
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
        Schema::dropIfExists('article_types');
    }
}
