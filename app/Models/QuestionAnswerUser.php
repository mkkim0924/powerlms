<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAnswerUser extends Model
{
    protected $table = 'question_answer_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'course_id',
        'quiz_id',
        'question_id',
        'user_answer',
        'is_correct_answer',
    ];
}
