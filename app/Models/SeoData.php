<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoData extends Model
{
    use HasFactory;

    protected $table = 'seo_data';

    protected $fillable = [
        'model_type',
        'model_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
    ];

    /**
     * Get the owning model.
     */
    public function model()
    {
        return $this->morphTo();
    }
}