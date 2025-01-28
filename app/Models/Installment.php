<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'installment_amount',
        'installment_number',
        'percentage',
        'due_date',
        'status',
    ];

    // علاقة القسط بالبيع
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
