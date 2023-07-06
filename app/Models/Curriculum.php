<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curriculum extends Model
{
    use SoftDeletes;

    protected $table = 'curriculum';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'section_id',
        'curriculum_list_id',
        'name',
        'curriculum_type',
        'curriculum_slug',
        'course_slug',
        'time',
        'sort_order',
        'is_active',
        'has_pending_comments',
    ];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function getSectionChildData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Curriculum::class, 'section_id', 'section_id')->whereIn('curriculum_type', ['unit', 'quiz'])->where('is_active', 1)->orderBy('sort_order');
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function sectionDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sections::class, 'id', 'section_id');
    }

    public function unitDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Units::class, 'id', 'curriculum_list_id');
    }

    public function quizDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Quiz::class, 'id', 'curriculum_list_id');
    }

    public function relatedComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CurriculumReview::class, 'curriculum_id', 'id');
    }
}
