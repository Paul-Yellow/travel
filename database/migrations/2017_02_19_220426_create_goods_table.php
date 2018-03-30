<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); // 商品名称
            $table->string('other_name'); // 别名或其他名称
            $table->integer('goods_category_id'); // 商品分类id
            $table->integer('goods_model_id'); // 商品模型id，需要记录，用户修改时找回规格的名称
            $table->string('img')->nullable(); // 商品图片
            $table->string('goods_no')->unique(); // 商品编号,商品英文名称缩写2位+1001开始
            $table->decimal('shop_price', 8, 2)->default(0.00); // 本店商品价格，保留2位小数
            $table->decimal('market_price', 8, 2)->default(0.00); // 市场商品价格，保留2位小数
            $table->integer('store_num')->default(1); // 库存数量
            $table->string('seo_title')->nullable(); // seo标题
            $table->string('seo_keywords')->nullable(); // seo关键词
            $table->string('seo_description')->nullable(); // seo描述
            $table->string('intro')->nullable(); // 商品简介
            $table->text('content_html')->nullable(); // html的内容介绍
            $table->tinyInteger('is_hot')->default(0); // 是否热卖
            $table->tinyInteger('is_new')->default(0); // 是否新品
            $table->tinyInteger('is_recommend')->default(0); // 是否推荐
            $table->tinyInteger('is_discount')->default(0); // 是否折扣
            $table->tinyInteger('status')->default(1); // 是否上架
            $table->tinyInteger('sort_num')->default(1); // 排序权重
            $table->string('three_level_value')->default('0-0-0'); // 方便修改表单初始化时使用
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
		Schema::drop('goods');
	}

}
