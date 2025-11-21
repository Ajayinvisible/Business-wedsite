<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BogPost extends Model
{
    protected $fillable = [
        'blog_cat_id',
        'post_title',
        'post_slug',
        'post_description',
        'image',
    ];
}
