<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    const IMAGE_DIMENSION = ['width' => 1920, 'height' => 1080];

    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image', 'hero_text', 'sub_text', 'button_text', 'text_color','action_type',
        'button_url', 'created_at', 'updated_at', 'deleted_at'];

}
