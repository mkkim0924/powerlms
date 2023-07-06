<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSurvey extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'course_surveys';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'course_id', 'survey_type','name','description','is_active','is_skippable','view_type'];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
    
    public function surveyQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseSurveyQuestion::class, 'survey_id', 'id');
    }
  
    public function surveyQuestionsOption(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseSurveyQuestionOptions::class, 'survey_id', 'id');
    }
    public function userCourseSurvey(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserCourseSurvey::class, 'survey_id', 'id');
    }
    
}
