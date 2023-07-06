<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    const IMAGE_DIMENSION = ['width' => 800, 'height' => 600];

    protected $table = 'bundles';

    protected $primaryKey = 'id';

    protected $fillable = ['instructor_id','category_id', 'name', 'slug', 'price','total_enrollments', 'image', 'start_date', 'is_active', 'end_date', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1)->whereHas('instructorDetail')->where(function ($qq){
            $qq->whereNull('start_date')->orWhere(function ($sq){
                $sq->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now());
            });
        });
    }

    public function categoryDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function instructorDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function relatedCourses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BundleCourse::class , "bundle_id", "id");
    }
}
