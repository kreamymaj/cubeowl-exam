<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('productID');
            $table->string('image')->nullable(); 
            $table->string('productName');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->string('productStatus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::table('products', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
