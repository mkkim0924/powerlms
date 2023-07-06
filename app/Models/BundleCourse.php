<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    protected $table = 'bundle_courses';

    protected $primaryKey = 'id';

    protected $fillable = ['bundle_id', 'course_id'];

    public function courseDetails()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function bundleDetails()
    {
        return $this->hasOne(Bundle::class, 'id', 'bundle_id');
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class , "course_id", "course_id");
    }
}
