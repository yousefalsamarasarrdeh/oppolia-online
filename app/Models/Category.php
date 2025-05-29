<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'title_ar', 'image', 'status', 'parent_id'];

    public function subcategories() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // دالة لجلب الفئة الأساسية
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
