<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveLessonUserEventLog extends Model
{
    protected $table = 'live_lesson_user_event_log';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'live_lesson_slot_id', 'event'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function slotDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LiveLessonSlot::class, 'id', 'user_id')->withTrashed();
    }
}
