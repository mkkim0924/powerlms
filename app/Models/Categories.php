<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    const IMAGE_DIMENSION = ['width' => 512, 'height' => 512];

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = ['name','slug','image', 'icon', 'is_active'];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
