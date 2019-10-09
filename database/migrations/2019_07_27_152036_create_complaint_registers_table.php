<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cust_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('complainttype_id');
            $table->dateTime('registered_date');
            $table->string('status', 20);
            $table->dateTime('closed_date')->nullable();
            $table->bigInteger('eid_alloted')->nullable();
            $table->string('cust_remarks', 255)->nullable();
            $table->string('engineer_remarks', 255)->nullable();
            $table->integer('other_charges');
            $table->integer('total_charges');
            $table->integer('is_repeat');
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
        Schema::dropIfExists('complaint_registers');
    }
}
