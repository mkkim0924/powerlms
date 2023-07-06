<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveLessonSlot extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'live_lesson_slots';

    protected $primaryKey = 'id';

    protected $fillable = ['live_lesson_id', 'course_id', 'meeting_id', 'title', 'description', 'start_at', 'end_at', 'duration', 'password', 'start_url', 'join_url', 'remaining_seats', 'reminder_sent'];

    protected $casts = ['start_at' => 'datetime', 'end_at' => 'datetime'];

    public function scopeByInstructor($q)
    {
        $q->whereHas('liveLessonDetails', function ($qq){
            $qq->byInstructor();
        });
    }

    public function liveLessonDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LiveLesson::class, 'id', 'live_lesson_id');
    }

    public function slotUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LiveLessonSlotUser::class, 'live_lesson_slot_id', 'id');
    }
}
