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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->string('category');
            $table->string('upload_type');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('price');
            $table->string('country');
            $table->string('state');
            $table->string('material');
            $table->string('video');
            $table->longText('description');
            $table->string('certificate_status');
            $table->integer('course_duration');
            $table->string('host_app');
            $table->string('slug_url');
            $table->string('featured_image');
            $table->integer('featured');
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
        Schema::dropIfExists('uploads');
    }
};
