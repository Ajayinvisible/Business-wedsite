<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'undefine_title',
        'undefine_icon',
        'undefine_description',
        'real_title',
        'real_icon',
        'real_description',
    ];
}
