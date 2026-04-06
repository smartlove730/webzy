<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    /**
     * Get the sections associated with the page.
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}