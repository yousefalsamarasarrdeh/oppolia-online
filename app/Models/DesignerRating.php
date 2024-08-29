<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'designer_id',
        'user_id',
        'rating',
        'review',
    ];

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
