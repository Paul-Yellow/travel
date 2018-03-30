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
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable()->default('/images/default-avatar.png');
            $table->string('iphone',12)->unique()->comment("注册手机");
            $table->string('password',60);
            $table->string('address')->nullable()->comment("用户地址");
            $table->string('sex')->nullable()->comment("性别");
            $table->tinyInteger('status')->default(1)->comment("1-正常，2-禁用");
            $table->tinyInteger('confirm_email')->default(2)->comment('1-验证，2-没验证');
            // 文章热度 缓存
            $table->unsignedInteger('credit_cache')->default(0)->index();
            // 文章缓存
            $table->unsignedInteger('post_cache')->default(0)->index();
            // 评论缓存
            $table->unsignedInteger('comment_cache')->default(0)->index();
            // 关注缓存
            $table->unsignedInteger('follower_cache')->default(0)->index();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
