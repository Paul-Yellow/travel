<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods_attributes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('model_id')->comment('模型id');
            $table->string('name')->index()->comment('属性名称。允许重复');
            $table->tinyInteger('is_search')->default(1)->comment('是否参与搜索条件查询或过滤');
            $table->tinyInteger('input_type')->default(1)->comment('1:手工录入, 2:单选录入, 3:多行文本录入');
            $table->tinyInteger('sort_num')->default(1)->comment('排序权重');
            $table->text('select_value')->nullable()->comment('单选录入时的可选值。一行一个，取出来时用\n分割');
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
		Schema::drop('goods_attributes');
	}

}
