<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class Admins extends Authenticatable
{
    use SoftDeletes,ThrottlesLogins;

    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = ['role_id', 'instructor_id','name', 'email', 'password', 'is_active', 'role_id', 'type', 'activation_date', 'activation_token', 'remember_token', 'image'];

    protected $dates = ['activation_date'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function relatedRole()
    {
        return $this->hasOne(AdminRole::class, "id", 'role_id');
    }

     public function instructorRole()
    {
        return $this->hasOne(User::class, "id", 'instructor_id');
    }

}
