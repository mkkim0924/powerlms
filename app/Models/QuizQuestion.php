<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'section_id', 'quiz_id', 'title', 'que_description', 'type'];

    public function setQueDescriptionAttribute($value)
    {
        $this->attributes['que_description'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function relatedOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizQuestionOption::class, 'question_id', 'id');
    }
}
