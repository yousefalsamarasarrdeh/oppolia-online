<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRegion extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'region_id'];

    // تعريف العلاقة مع region
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // علاقة sub_region بـ orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'sub_region_id');
    }
}
