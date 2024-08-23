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
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kyc_selfie');
            $table->string('status');
            $table->string('home_address');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('country');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('front_document');
            $table->string('back_document');
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
        Schema::dropIfExists('kyc_verifications');
    }
};
