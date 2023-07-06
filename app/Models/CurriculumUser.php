<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumUser extends Model
{
    protected $table = 'curriculum_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'course_id',
        'curriculum_id',
        'module_id',
        'module_type',
        'is_completed',
    ];

    public function curriculumDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Curriculum::class, 'id', 'curriculum_id');
    }
}
