<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttributeValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->unsignedBigInteger('id_attribute');
            $table->foreign('id_attribute')->references('id')->on('attribute');
            // $table->timestamps();
           
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
            $table->dropForeign(['id_attribute']);   
        });
        Schema::dropIfExists('attribute_value');
    }
}
