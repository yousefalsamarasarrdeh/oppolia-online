<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignerMeetingCustomer extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'order_id',

        'is_verified',
        'meeting_time',
    ];

    // العلاقة مع جدول orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
