<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinAsADesigner extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'join_as_a_designer';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'city_town',
        'country',
        'email_address',
        'phone_number',
        'age',
        'nationality',
        'gender',
        'marital_status',
        'current_country',
        'current_city',
        'preferred_city',
        'major_in_education',
        'years_of_experience',
        'experience_in_sales',
        'current_occupation',
        'willing_to_work_as_freelancer',
        'own_car',
        'experience_in_kitchen_furniture_business',
        'kitchen_furniture_experience_description',
        'cv_pdf_path',
        'status', // Default is 'unread'
    ];

    // Cast boolean fields
    protected $casts = [
        'experience_in_sales' => 'boolean',
        'current_occupation' => 'boolean',
        'willing_to_work_as_freelancer' => 'boolean',
        'own_car' => 'boolean',
        'experience_in_kitchen_furniture_business' => 'boolean',
    ];
}
