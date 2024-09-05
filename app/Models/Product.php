<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'name_ar', 'image', 'sku'
    ];

    /**
     * Get the descriptions for the product.
     */
    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
