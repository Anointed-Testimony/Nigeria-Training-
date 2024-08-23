<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('user_type');
            $table->string('name');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('telephone');
            $table->string('gender')->nullable();
            $table->string('address');
            $table->string('category')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('industry')->nullable();
            $table->integer('wallet_balance');
            $table->string('kyc_status')->default('not verified');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('bank_account');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
};
