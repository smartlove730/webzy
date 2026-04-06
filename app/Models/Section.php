<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'identifier',
        'title',
        'content',
        'order',
    ];

    /**
     * Get the page that owns the section.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}