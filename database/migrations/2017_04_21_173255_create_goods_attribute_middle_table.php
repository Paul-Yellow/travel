<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeMiddleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attribute_middle', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('goods_id')->comment('商品id');
            $table->integer('attribute_id')->comment('商品对应的属性id');
            $table->text('attr_value')->comment('商品属性的值');
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
        //
        Schema::drop('goods_attribute_middle');
    }
}
