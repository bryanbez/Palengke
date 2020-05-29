<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerProfileMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCustomerProfile', function(Blueprint $table) {
            $table->string('customer_username');
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('customer_middle_name');
            $table->text('customer_address');
            $table->string('customer_cp_number')->max(11);
            $table->string('customer_birthdate');
            $table->string('is_verified_cp_number')->default('false');
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
        Schema::drop('tblCustomerProfile');
    }
}
