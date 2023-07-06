<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveLesson extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'live_lessons';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'instructor_id', 'title', 'description'];

    public function scopeByInstructor($q)
    {
        $q->where('instructor_id', request()->user_id);
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, "id", 'course_id');
    }
}
