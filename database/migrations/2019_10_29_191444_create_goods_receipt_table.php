<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_receipt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->float('unit_price');
            $table->float('total');
            $table->dateTime('date');
            $table->integer('status');


              //ForeignKey
              $table->unsignedBigInteger('id_product');
              $table->foreign('id_product')->references('id')->on('products');

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
        Schema::table('goods_receipt', function (Blueprint $table) {
            $table->dropForeign(['id_product']); 
        });
        Schema::dropIfExists('goods_receipt');
    }
}
