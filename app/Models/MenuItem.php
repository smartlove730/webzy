<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'title',
        'url',
        'parent_id',
        'order',
    ];

    /**
     * Belongs to a menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Parent item relation.
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Children relation.
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}