<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'author_id', 'author_name', 'rating', 'comment'];

    public function userDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id')->select('id', 'name', 'email', 'image');
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id')->select('id', 'name', 'slug');
    }
}
