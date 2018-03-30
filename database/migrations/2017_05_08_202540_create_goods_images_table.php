<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsImagesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods_images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->index()->comment('商品id');
            $table->string('url')->comment('商品图片url');
            $table->string('other_params')->comment('其他参数');
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
		Schema::drop('goods_images');
	}

}
