<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitieEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitie_event', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            // 类型
            $table->string('category_name');
            $table->integer('category_id')->unsigned();
            $table->string('title')->comment('活动标题');
            $table->string('area')->comment('活动地点');
            $table->string('ln')->comment('经度');
            $table->string('lo')->comment('纬度');
            $table->string('imgUrl')->comment('活动封面');
            $table->timestamp('date')->nullable()->comment('活动时间');
            $table->text('content')->comment('活动内容');
            $table->string('content_short')->comment('内容简介');
            $table->tinyInteger('view_count')->unsigned()->default(0)->index()->comment('浏览人数');
            // 主办单位
            $table->string('sponsor')->comment('主办单位');
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
        Schema::dropIfExists('activitie_event');
    }
}
