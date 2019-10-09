<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cust_name', 30);
            $table->string('cust_mobile', 10);
            $table->string('cust_alt_mobile', 10);
            $table->string('cust_email', 50);
            $table->string('cust_address', 255);
            $table->string('cust_city', 20);
            $table->string('cust_state', 20);
            $table->string('password', 255);
            $table->integer('is_Active');
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
        Schema::dropIfExists('customers');
    }
}
