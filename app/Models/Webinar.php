<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use HasFactory;

    use SoftDeletes;

    const IMAGE_DIMENSION = ['width' => 800, 'height' => 600];

    protected $table = 'webinars';

    protected $primaryKey = 'id';

    protected $fillable = ['category_id', 'instructor_id', 'name', 'slug', 'duration', 'short_description', 'description', 'image', 'start_at', 'end_at',
        'live_streaming_url', 'intro_video_url', 'total_enrollments', 'related_courses', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = ['related_courses' => 'array', 'start_at' => 'datetime', 'end_at' => 'datetime'];


    public function scopeByActive($q)
    {
        $q->whereHas('instructorDetail');
    }

    public function categoryDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function instructorDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function scopeByInstructor($q)
    {
        $q->where('instructor_id', request()->user_id);
    }
}
