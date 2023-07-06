<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'quiz';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'section_id', 'name', 'slug', 'content', 'time', 'retake', 'is_active'];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function sectionDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sections::class, 'id', 'section_id');
    }

    public function relatedQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id', 'id');
    }
}
