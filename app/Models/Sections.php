<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sections extends Model
{
    use SoftDeletes;

    protected $table = 'sections';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'name', 'is_active'];

    //Relationships
    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, "id", 'course_id');
    }
}
