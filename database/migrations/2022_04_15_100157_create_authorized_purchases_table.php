<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizedPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorized_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('employee_id');
            $table->integer('vehicle_id');
            $table->integer('amount');
            $table->string('payment_type');
            $table->string('status');
            $table->string('name');
            $table->string('document_url');
            $table->timestamps();
            $table->string('sales_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorized_purchases');
    }
}
