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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id'); // البيعة المرتبطة
            $table->decimal('installment_amount', 10, 2); // مبلغ القسط
            $table->unsignedInteger('installment_number'); // رقم القسط
            $table->decimal('percentage', 5, 2); // النسبة المئوية
            $table->date('due_date')->nullable(); // تاريخ الاستحقاق
            $table->enum('status', ['pending', 'paid', 'overdue']); // حالة القسط
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
