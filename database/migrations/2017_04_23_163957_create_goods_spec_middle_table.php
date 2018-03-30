<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSpecMiddleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_spec_middle', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('goods_id')->comment('商品id');
            $table->integer('spec_id')->comment('商品对应的规格id');
            $table->string('spec_value')->nullable()->comment('商品规格的值');
            $table->tinyInteger('is_use')->default(0)->comment('商品规格的值');
            $table->decimal('price')->default(0.00)->comment('规格的附加价格');
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
        Schema::drop('goods_spec_middle');
    }
}
