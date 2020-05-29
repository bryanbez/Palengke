<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerCart', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->string('customer_name');
            $table->integer('product_id');
            $table->float('price');
            $table->integer('quantity');
            $table->float('total_price');
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
        Schema::drop('customerCart');
    }
}
