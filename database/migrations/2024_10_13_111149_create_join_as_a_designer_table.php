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
        Schema::create('join_as_a_designer', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city_town');
            $table->string('country');
            $table->string('email_address')->unique();
            $table->string('phone_number')->unique();
            $table->integer('age');
            $table->string('nationality');
            $table->enum('gender', ['male', 'female',]);
            $table->enum('marital_status', ['single', 'married', 'other']);
            $table->string('current_country');
            $table->string('current_city');
            $table->string('preferred_city');
            $table->string('major_in_education');
            $table->integer('years_of_experience');
            $table->boolean('experience_in_sales');
            $table->boolean('current_occupation');
            $table->boolean('willing_to_work_as_freelancer');
            $table->boolean('own_car');
            $table->boolean('experience_in_kitchen_furniture_business');
            $table->text('kitchen_furniture_experience_description')->nullable();
            $table->string('cv_pdf_path'); // Path to the uploaded CV PDF file
            $table->enum('status', ['read', 'unread', 'rejected', 'pending', 'accepted'])->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_as_a_designer');
    }
};
