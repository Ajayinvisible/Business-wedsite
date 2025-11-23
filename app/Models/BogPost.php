<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BogPost extends Model
{
    protected $fillable = [
        'blog_cat_id',
        'post_title',
        'post_slug',
        'post_description',
        'image',
    ];

    public function category() :BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_cat_id');
    }
}
