<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    const IMAGE_DIMENSION = ['width' => 300, 'height' => 150];

    protected $table = 'sponsors';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'link', 'image'];
}
