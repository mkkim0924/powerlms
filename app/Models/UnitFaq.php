<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitFaq extends Model
{
    protected $table = 'unit_faqs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'unit_id',
        'question',
        'answer',
    ];

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }
}
