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
        Schema::create('designer_meeting_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // مرتبط بالطلب

            $table->boolean('is_verified')->default(false)->nullable(); // هل تم التحقق من الزبون
            $table->timestamp('meeting_time')->nullable(); // موعد اللقاء
            $table->timestamps();

            // إنشاء المفتاح الخارجي للعلاقة مع جدول orders
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designer_meeting_customers');
    }
};
