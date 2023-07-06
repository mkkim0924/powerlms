<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'ltm_translations';

    protected $primaryKey = 'id';

    protected $fillable = ['status', 'locale', 'group', 'key', 'value'];
}
