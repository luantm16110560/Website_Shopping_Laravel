<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->float('unit_price');// đơn giá
            $table->float('promotion_price');
            $table->integer('amount');
            $table->string('image');
            $table->integer('status');
        
            //ForeignKey
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('type_products');

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
        $table->dropForeign(['id_type']);
        Schema::dropIfExists('products');
        
    }
}
