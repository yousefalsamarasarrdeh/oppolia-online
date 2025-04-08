<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'region_id',
        'sub_region_id',
        'phone',
        'message',
    ];

    // علاقة مع Region
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // علاقة مع SubRegion
    public function subRegion()
    {
        return $this->belongsTo(SubRegion::class);
    }
}
