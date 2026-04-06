<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'category',
        'project_date',
        'location',
        'image',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];
}