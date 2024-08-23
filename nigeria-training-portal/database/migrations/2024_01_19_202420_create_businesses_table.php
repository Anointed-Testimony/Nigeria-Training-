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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->string('businessname');
            $table->string(('website'));
            $table->string(('subscription'))->default('basic listing');
            $table->string(('verification_badge'));
            $table->string('business_type');
            $table->string('specialization')->nullable();
            $table->string('contact_person');
            $table->longText('description');
            $table->string('business_slug');
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
        Schema::dropIfExists('businesses');
    }
};
