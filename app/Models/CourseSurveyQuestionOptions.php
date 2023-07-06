<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSurveyQuestionOptions extends Model
{
    use HasFactory;

    protected $table = 'course_survey_question_options';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'survey_id', 'survey_question_id','option_id','content'];

    public function surveyDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseSurvey::class, 'id', 'survey_id');
    }
}
