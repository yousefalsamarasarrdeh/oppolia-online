<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region_id',
        'sub_region_id', // حقل sub_region_id لإضافة العلاقة مع SubRegion
        'kitchen_area',
        'kitchen_shape',
        'kitchen_type',
        'expected_cost',
        'time_range',
        'kitchen_style',
        'meeting_time',
        'length_step',
        'width_step',
        'geocode_string',
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

    // علاقة order بـ region
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // علاقة order بـ sub_region
    public function subRegion()
    {
        return $this->belongsTo(SubRegion::class);
    }

    // علاقة order بـ designer
    public function designer()
    {
        return $this->belongsTo(Designer::class, 'approved_designer_id');
    }

    public function designerMeetings()
    {
        return $this->hasMany(DesignerMeetingCustomer::class);
    }

    public function surveyQuestions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    public function orderDraft()
    {
        return $this->hasMany(OrderDraft::class);
    }
}
