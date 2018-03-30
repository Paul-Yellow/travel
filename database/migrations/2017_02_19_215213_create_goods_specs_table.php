<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSpecsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods_specs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('model_id');
            $table->tinyInteger('sort_num')->default(1);
            $table->text('select_value')->nullable();
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
		Schema::drop('goods_specs');
	}

}
