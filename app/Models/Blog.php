<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    const IMAGE_DIMENSION = ['width' => 700, 'height' => 700];

    protected $table = 'blogs';

    protected $primaryKey = 'id';

    protected $fillable = ['category_id', 'title', 'slug', 'content', 'image', 'author_name',
        'meta_title', 'meta_description', 'meta_keywords'];

    public function categoryDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BlogCategory::class, "id", 'category_id');
    }

}
