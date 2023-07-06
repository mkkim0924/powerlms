<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Clue\StreamFilter\fun;

class ChatThread extends Model
{
    protected $table = 'chat_threads';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'course_id', 'course_user_id'];

    public function chatParticipants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ChatParticipant::class, 'thread_id', 'id');
    }

    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasone(Course::class, 'id', 'course_id')->select('id', 'instructor_id', 'name', 'slug', 'image');
    }

    public function userDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasone(User::class, 'id', 'user_id')->select('id', 'name');
    }

    public function chatMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ChatMessage::class, 'thread_id', 'id');
    }

    public function unreadChatMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ChatMessage::class, 'thread_id', 'id')->whereHas('chatParticipants', function ($q) {
            $q->where('user_id', auth()->user()->id);
        })->whereNull('read_at')->where('user_id', '!=', auth()->user()->id);
    }
}
