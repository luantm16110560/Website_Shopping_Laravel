<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_user');


            $table->foreign('id_user')->references('id')->on('users');
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
        
        Schema::table('user_review', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_product']);      
        });
        Schema::dropIfExists('user_review');
    }
}
