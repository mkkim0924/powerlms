<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $table = 'locales';

      protected $fillable = ['name', 'short_name', 'display_type', 'is_default'];
}
