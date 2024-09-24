<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Designer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{   use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kitchen_area',
        'kitchen_shape',
        'kitchen_type',
        'expected_cost',
        'time_range',
        'kitchen_style',
        'meeting_time',
        'length_step',
        'width_step',
        'designer_code',
        'order_status',
        'processing_stage',
        'approved_designer_id'
    ];

    // علاقة order بـ user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة order بـ designer
    public function designer()
    {
        return $this->belongsTo(Designer::class, 'approved_designer_id');
    }
}
