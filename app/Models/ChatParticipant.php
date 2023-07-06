<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatParticipant extends Model
{
    protected $table = 'chat_participants';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'thread_id'];
}
