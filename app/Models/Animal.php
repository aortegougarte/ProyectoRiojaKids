<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'photo_url',
        'environment',
        'animal_type',
        'habitat',
        'scientific_name',
        'diet',
        'lifespan_years',
        'size_cm',
        'weight_kg',
        'description',
    ];
}
