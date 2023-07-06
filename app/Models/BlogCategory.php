<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_categories';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name', 'slug'];

    public function relatedBlogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
