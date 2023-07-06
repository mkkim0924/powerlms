<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Faqs extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'question', 'answer'];

    public function courseDetail()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
