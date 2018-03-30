<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            // 类型
            $table->string('title')->comment('标题');
            $table->string('imgUrl')->comment('封面');
            $table->timestamp('date')->nullable()->comment('时间');
            $table->text('content')->comment('内容');
            $table->string('content_short')->comment('内容简介');
            $table->tinyInteger('view_count')->unsigned()->default(0)->index()->comment('浏览人数');
            // 评论缓存
            $table->unsignedInteger('comment_cache')->default(0)->index();
            // 爱心缓存
            $table->unsignedInteger('like_cache')->default(0)->index();
            // 收藏缓存
            $table->unsignedInteger('favorite_cache')->default(0)->index();
            // 索引
            $table->unsignedInteger('user_id')->index();
            // 外建
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('talent');
    }
}
