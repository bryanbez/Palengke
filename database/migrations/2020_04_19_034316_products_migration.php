<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->bigIncrements('product_id');
            $table->string('product_name', 255);
            $table->text('product_desc');
            $table->string('category', 255);
            $table->float('product_price', 8, 2);
            $table->string('store_of', 255);
            $table->integer('stocks_left');
            $table->text('product_image')->nullable();
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
        Schema::drop('products');
    }
}
