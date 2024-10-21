<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Designer;
use App\Models\DesignerMeetingCustomer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{   use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'region_id',
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

    public function region()
    {
        return $this->belongsTo(Region::class);
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
    Public function orderDraft(){
        return $this->hasMany(OrderDraft::class);
    }
}
