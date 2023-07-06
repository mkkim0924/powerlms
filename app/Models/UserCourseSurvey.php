<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourseSurvey extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'user_course_survey';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'survey_id', 'user_id','is_skipped'];

    public function surveyDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseSurvey::class, 'id', 'survey_id');
    }
    public function userCourseSurveyHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserCourseSurveyHistory::class, 'user_course_survey_id', 'id');
    }
}
