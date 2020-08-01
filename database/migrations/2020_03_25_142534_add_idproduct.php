<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdproduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_value', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_product');
           $table->foreign('id_product')->references('id')->on('products');
           $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attribute_value', function (Blueprint $table) {
            //

            $table->dropForeign(['id_product']); 
            $table->dropColumn('amount');
            $table->dropColumn('id_product');       
        });
    }
}
