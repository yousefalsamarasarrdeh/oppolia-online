<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'hear_about_oppolia',
        'expected_delivery_time',
        'client_budget',
        'kitchen_room_size',
        'kitchen_use',
        'kitchen_style_preference',
        'appliances_needed',
        'sink_type',
        'worktop_preference',
        'general_info',
        'customer_concerns',
        'next_steps_strategy',
        'reminder_details',
        'deal_closing_likelihood',
        'measurements_images',
    ];

    // علاقة SurveyQuestion بـ Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
