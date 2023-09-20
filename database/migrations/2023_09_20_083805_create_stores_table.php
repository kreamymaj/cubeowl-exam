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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('storeID');
            $table->string('storeName');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('mobileNum');
            $table->integer('landline');
            $table->string('storeStatus')->default('Inactive'); 
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
        Schema::dropIfExists('stores');
        Schema::table('stores', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};