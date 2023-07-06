<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionOption extends Model
{
    protected $table = 'quiz_question_options';

    protected $primaryKey = 'id';

    protected $fillable = ['quiz_id', 'question_id', 'option_id', 'content', 'is_correct_answer'];
}
