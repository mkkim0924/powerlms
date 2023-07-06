<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInterviewQuestion extends Model
{
    use HasFactory;

    protected $table = 'course_interview_questions';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'course_id', 'question', 'answer'];

    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
