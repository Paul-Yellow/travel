<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->unique()->comment('订单编号，唯一。生成规则：规则：订单类型（1位） + 年(2位) + 月日时分秒（10位）+ 用户id');
            $table->integer('user_id')->index()->comment('用户id');
            $table->tinyInteger('status')->default(1)->comment('支付状态：0已删除 1已生成未付款 2已付款 3已过期');
            $table->tinyInteger('pay_type')->default(0)->comment('支付类型：0未支付 1支付宝 2微信 3网银');
            $table->string('pay_code')->default('')->comment('支付端返回的订单号');
            $table->decimal('goods_price')->default(0.00)->comment('商品总价');
            $table->decimal('service_price')->default(0.00)->comment('服务费总价');
            $table->decimal('total_price')->default(0.00)->comment('支付总价格');
            $table->unsignedInteger('pay_time')->index()->default(0)->comment('支付成功时间');
            $table->string('remark')->default('')->comment('用户备注');
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
		Schema::drop('orders');
	}

}
