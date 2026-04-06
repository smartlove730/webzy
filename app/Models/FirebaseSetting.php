<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_key',
        'sender_id',
        'project_id',
    ];
}