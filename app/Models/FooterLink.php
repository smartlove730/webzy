<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_section_id',
        'title',
        'url',
        'order',
    ];

    /**
     * Footer section relation.
     */
    public function section()
    {
        return $this->belongsTo(FooterSection::class, 'footer_section_id');
    }
}