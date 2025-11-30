<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    public function posts() :HasMany
    {
        return $this->hasMany(BlogPost::class, 'blog_cat_id');
    }
}
