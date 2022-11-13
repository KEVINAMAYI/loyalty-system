<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('vehicle_registration');
            $table->string('product')->nullable();
            $table->string('rewards_used');
            $table->string('rewards_awarded');
            $table->integer('amount_payable');
            $table->integer('amount_paid');
            $table->string('image_url');
            $table->string('pump_image_url');
            $table->string('receipt_image_url');
            $table->string('sold_by');
            $table->string('rewards_balance');
            $table->string('status');
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
