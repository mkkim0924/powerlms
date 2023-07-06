<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{

    use SoftDeletes;

    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description',
        'meta_keywords', 'created_at', 'updated_at', 'deleted_at'];

    public function setContentAttribute($value)
    {
        //$this->attributes['content'] = str_replace(['<script>', '</script>'], ['', ''], $value);
        $this->attributes['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }
}
