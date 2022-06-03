<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('phone_number')->nullable();
            $table->integer('alternative_phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('krapin')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('logo_url')->nullable();
            $table->string('major_role')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_email')->unique();
            $table->integer('contact_person_phone')->nullable();
            $table->integer('contact_person_alternative_phone')->nullable();
            $table->string('country')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
