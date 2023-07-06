<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseSurveyHistory extends Model
{
    use HasFactory;

    protected $table = 'user_course_survey_histories';

    protected $primaryKey = 'id';

    protected $fillable = ['user_course_survey_id', 'question_id', 'answers'];

    public function courseSurveyQuestion(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseSurveyQuestion::class, 'id', 'question_id');
    }
}
