<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDraft extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'price',
        'images',

        'pdf',
        'state',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
