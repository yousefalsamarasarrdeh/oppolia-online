<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'total_cost',
        'price_after_discount',
        'discount_percentage',
        'amount_paid',
        'paid_percentage',
        'installments_count',
        'status',
    ];

    // علاقة المبيعات بالطلب
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // علاقة المبيعات بالأقساط
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
