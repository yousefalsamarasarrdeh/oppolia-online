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
        Schema::create('order_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // مرتبط بالطلب
            $table->decimal('price', 15, 3); // السعر
            $table->json('images')->nullable(); // JSON for multiple images

            $table->string('pdf')->nullable(); // Path to PDF file
            $table->enum('state', ['draft', 'finalized', 'approved', 'rejected']); // State of the draft
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_draft');
    }
};
