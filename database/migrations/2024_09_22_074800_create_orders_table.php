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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // id_user
            $table->unsignedBigInteger('region_id'); // id_region
            $table->unsignedBigInteger('sub_region_id')->nullable(); // id_sub_region (nullable)
            $table->decimal('kitchen_area', 8, 2); // مساحة المطبخ
            $table->string('kitchen_shape'); // شكل المطبخ
            $table->enum('kitchen_type', ['قديم', 'جديد']); // نوع المطبخ (قديم أو جديد)
            $table->decimal('expected_cost', 10, 2); // الكلفة المتوقعة
            $table->string('time_range'); // المدى الزمني لتصميم المطبخ
            $table->string('kitchen_style'); // نوع ستايل المطبخ
            $table->timestamp('meeting_time'); // وقت اللقاء
            $table->decimal('length_step', 8, 5); // خطوة الطول من Google Maps
            $table->decimal('width_step', 8, 5); // خطوة العرض من Google Maps
            $table->string('geocode_string'); // العنوان الجغرافي كنص (Geocode)
            $table->string('designer_code')->nullable(); // كود المصمم (nullable)
            $table->enum('order_status', ['accepted', 'rejected', 'closed', 'pending'])->default('pending'); // حالة الطلب
            $table->enum('processing_stage', [
                'stage_one',
                'stage_two',
                'stage_three',
                'stage_four',
                'stage_five',
                'stage_six',
                'stage_seven',
                'stage_eight',
                'stage_nine',
                'stage_ten',
                'stage_eleven',
                'stage_twelve',
                'stage_thirteen',
                'stage_fourteen',
                'stage_fifteen',
                'stage_sixteen',
                'stage_seventeen',
                'stage_eighteen',
                'change_designer'
            ])->default('stage_one');
            $table->unsignedBigInteger('approved_designer_id')->nullable(); // المصمم الموافق

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade'); // علاقة بالمنطقة
            $table->foreign('sub_region_id')->references('id')->on('sub_regions')->onDelete('set null'); // علاقة بالـ sub_region
            $table->foreign('approved_designer_id')->references('id')->on('designers')->onDelete('set null');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
