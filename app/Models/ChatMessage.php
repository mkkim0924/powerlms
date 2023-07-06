<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $primaryKey = 'id';

    protected $fillable = ['thread_id', 'user_id', 'body', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function chatParticipants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ChatParticipant::class, 'thread_id', 'thread_id');
    }
}
