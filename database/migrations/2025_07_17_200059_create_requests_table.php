<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('join_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('about_me')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('id_number');
            $table->unsignedBigInteger('job_title_id');
            $table->foreign('job_title_id')->on('job_titles')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->on('areas')->references('id')->onDelete('cascade');
            $table->string('image');
            $table->string('logo');
            $table->string('id_image_front');
            $table->string('id_image_back');
            $table->string('graduation_certificate');
            $table->string('professional_license')->comment('شهادة مزاولة المهنه');
            $table->string('syndicate_card')->comment('كارنية النقابه');
            $table->string('organization_name');
            $table->string('organization_address');
            $table->string('organization_phone_first');
            $table->string('organization_phone_second')->nullable();
            $table->string('organization_phone_third')->nullable();
            $table->string('organization_location_url')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('type', ['client', 'requester'])->default('requester');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
