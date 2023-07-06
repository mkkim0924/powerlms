<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSurveyQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'course_survey_questions';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'survey_id', 'title','type'];

    const control_type =  [
                        'multiple_choice' => 'Multiple Choice',//-----------
                        'single_choice' => 'Single Choice',//--------------
                        'yes_no' => 'Yes/No',
                        'text' => 'Short Text',
                        'textarea' => 'Long Text',
                        'ratings' => 'Ratings(in stars)', //--------
                        'true_false' => 'True/False',
                    ];

    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
    
    public function surveyDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseSurvey::class, 'id', 'survey_id');
    }
    public function surveyQuestionsOption(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseSurveyQuestionOptions::class, 'survey_question_id', 'id');
    }
    public function userCourseSurveyHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserCourseSurveyHistory::class, 'question_id', 'id');
    }
}
