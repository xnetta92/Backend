<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $casts = [
        'ingredients' => 'array',
    ];

    protected $nullable = [
        'description',
        'img_url'
    ];
    protected $fillable = [
        'category',
        'name',
        'description',
        'img_url',
        'ingredients',
        'price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
