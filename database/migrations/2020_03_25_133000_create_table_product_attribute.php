<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');

          

            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('products');

            
            $table->unsignedBigInteger('id_attribute_value');
            $table->foreign('id_attribute_value')->references('id')->on('attribute_value');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     
        Schema::table('product_attribute', function (Blueprint $table) {
            $table->dropForeign(['id_attribute_value']);
            $table->dropForeign(['id_product']);
        });
        Schema::dropIfExists('product_attribute');
    }
}
