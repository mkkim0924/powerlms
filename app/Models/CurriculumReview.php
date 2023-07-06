<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumReview extends Model
{
    protected $table = 'curriculum_reviews';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'curriculum_id', 'user_id', 'user_type', 'content'];
}
