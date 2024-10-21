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
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // مرتبط بالطلب
            $table->string('hear_about_oppolia')->nullable(); // كيف سمعت بابوليا
            $table->string('expected_delivery_time')->nullable(); // وقت التسليم المتوقع
            $table->decimal('client_budget', 10, 2)->nullable(); // ميزانية العميل
            $table->string('kitchen_room_size')->nullable(); // حجم المطبخ
            $table->string('kitchen_use')->nullable(); // استخدام المطبخ متعدد الاختيارات
            $table->string('kitchen_style_preference')->nullable(); // النمط المفضل للمطبخ
            $table->string('appliances_needed')->nullable(); // الأجهزة المطلوبة متعدد الاختيارات
            $table->string('sink_type')->nullable(); // نوع الحوض
            $table->string('worktop_preference')->nullable(); // نوع سطح العمل المفضل
            $table->text('general_info')->nullable(); // معلومات عامة عن الموقع والبناء
            $table->text('customer_concerns')->nullable(); // تساؤلات أو مخاوف العميل
            $table->text('next_steps_strategy')->nullable(); // الخطوات التالية واستراتيجيتك
            $table->timestamp('reminder_details')->nullable(); // تفاصيل التذكير
            $table->json('measurements_images')->nullable(); // JSON for measurement images
            $table->unsignedTinyInteger('deal_closing_likelihood')->nullable(); // احتمالية إتمام الصفقة (1-10)
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};
