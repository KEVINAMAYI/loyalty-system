$table->integer('low');
$table->integer('high');
$table->string('reward_type');
$table->double('shillings_per_litre');
$table->string('period');
$table->string('product_type');<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_rewards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->integer('low');
            $table->integer('high');
            $table->string('reward_type');
            $table->double('shillings_per_litre');
            $table->string('period');
            $table->string('product_type');
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
        Schema::dropIfExists('customer_rewards');
    }
}
