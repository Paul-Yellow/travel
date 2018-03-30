<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsOrdersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods_orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->index()->comment('对应的订单表id');
            $table->integer('goods_id')->index()->comment('商品id');
            $table->string('goods_name')->index()->comment('商品名称');
            $table->string('goods_sku')->comment('商品的sku名称');
            $table->string('goods_no')->index()->nullable()->comment('商品货号');
            $table->tinyInteger('goods_num')->comment('商品购买数量');
            $table->decimal('market_price')->comment('商品购买时的市场价格');
            $table->decimal('shop_price')->comment('商品购买时的本店价格');
            $table->string('spec_key')->comment('商品对应的规格id的拼接，1-2-3');
            $table->string('spec_name')->comment('商品的规格名称，和上面的拼接顺序对应');
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
		Schema::drop('goods_orders');
	}

}
