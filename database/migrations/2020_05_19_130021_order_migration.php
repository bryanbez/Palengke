<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblOrder', function(Blueprint $table) {
            $table->integer('order_id');
            $table->string('customer_name');
            $table->string('product_id');
            $table->integer('quantity');
            $table->float('total_price');
            $table->string('payment_method');
            $table->string('order_status');
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
        Schema::drop('tblOrder');
    }
}
