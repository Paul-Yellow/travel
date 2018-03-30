<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCategoriesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('alias_name')->index()->nullable();
            $table->integer('parent_id');
            $table->tinyInteger('sort_num')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->string('img')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
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
		Schema::drop('goods_categories');
	}

}
