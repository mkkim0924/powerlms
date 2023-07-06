<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveLessonSlotUser extends Model
{
    protected $table = 'live_lesson_slot_users';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'course_id', 'live_lesson_id', 'live_lesson_slot_id'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function slotDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LiveLessonSlot::class, 'id', 'live_lesson_slot_id');
    }
}
