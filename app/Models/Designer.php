<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Designer extends Model
{
    use HasFactory ,Notifiable;

    protected $fillable = [
        'user_id',
        'profile_image',
        'experience_years',
        'description',
        'description_ar',
        'portfolio_images', // هذا الحقل يستخدم json
        'designer_code',
    ];

    protected $casts = [
        'portfolio_images' => 'array', // تأكيد أن الحقل يعامل كـ array عند التعامل معه
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(DesignerRating::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'approved_designer_id');
    }


}

