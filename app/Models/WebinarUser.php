<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarUser extends Model
{
    protected $table = 'webinar_users';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'webinar_id', 'is_completed'];

    public function webinarDetails()
    {
        return $this->hasOne(Webinar::class, 'id', 'webinar_id');
    }
}
