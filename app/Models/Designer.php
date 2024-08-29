<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_image',
        'experience_years',
        'description',
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
}

