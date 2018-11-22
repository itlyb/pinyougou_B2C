<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->comment('电话号');
            $table->string('email')->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->unsignedInteger('level')->default(0)->comment('会员等级');
            $table->decimal('use_money', 10, 2)->default(0)->comment('消费金额');
            $table->unsignedTinyInteger('is_disable')->default(0)->comment('是否禁用');
            $table->string('address')->default('')->comment('住址');
            $table->string('post_code')->default('')->comment('邮编');
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
        Schema::dropIfExists('users');
    }
}
