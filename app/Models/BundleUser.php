<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleUser extends Model
{
    protected $table = 'bundle_users';

    protected $primaryKey = 'id';

    protected $fillable = ['bundle_id', 'user_id'];
}
