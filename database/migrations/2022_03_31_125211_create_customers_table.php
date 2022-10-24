<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('id_number');
            $table->string('email')->default("customer-email");
            $table->string('gender');
            $table->string('type')->nullable();
            $table->integer('rewards');
            $table->date('sale_start_date')->nullable();
            $table->date('sale_end_date')->nullable();
            $table->string('reward_type_to_use')->nullable();
            $table->integer('authorized_amount')->nullable();
            $table->string('purchase_status')->nullable();
            $table->string('status');
            $table->string('reason');
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
