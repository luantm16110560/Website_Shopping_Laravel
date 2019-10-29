<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_detail', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('amount');
            $table->float('unit_price');
            $table->integer('status');

            $table->unsignedBigInteger('id_bill');
            $table->foreign('id_bill')->references('id')->on('bills');

            
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
        $table->dropForeign(['id_bill']);
        $table->dropForeign(['id_product']);
        Schema::dropIfExists('bill_detail');
    }
}
