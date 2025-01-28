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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // الطلب المرتبط
            $table->decimal('total_cost', 10, 2); // التكلفة الإجمالية
            $table->decimal('price_after_discount', 10, 2); // السعر بعد الخصم
            $table->decimal('discount_percentage', 5, 2); // نسبة الخصم
            $table->decimal('amount_paid', 10, 2)->default(0); // التكلفة المدفوعة (القيمة الافتراضية 0)
            $table->decimal('paid_percentage', 5, 2)->default(0); // النسبة المئوية المدفوعة (القيمة الافتراضية 0)
            $table->unsignedInteger('installments_count')->default(0); // عدد الأقساط (القيمة الافتراضية 0)
            $table->enum('status', [
                'pending',
                'completed',
                'canceled',
                'open',
                'first_payment_done',
                'second_payment_done'
            ])->default('pending'); // الحالة الافتراضية "pending"
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
