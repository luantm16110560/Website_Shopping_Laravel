<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_order');
            $table->float('total');
            $table->string('payment');
            $table->string('note');
            $table->integer('status');

             //ForeignKey
             $table->unsignedBigInteger('id_customer');
             $table->foreign('id_customer')->references('id')->on('customers');


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
        $table->dropForeign(['id_customer']);
        Schema::dropIfExists('bills');
    }
}
