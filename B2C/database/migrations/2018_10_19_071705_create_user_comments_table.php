<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('user_comments', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('good_id')->comment('商品id');
            $table->string('content')->comment('评论内容');
            $table->unsignedTinyInteger('is_top')->comment('是否置顶');
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
        Schema::dropIfExists('user_comments');
    }
}
