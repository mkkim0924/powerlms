<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Units extends Model
{
    use SoftDeletes;

    const THUMBNAIL_IMAGE_DIMENSION = ['width' => 746, 'height' => 420];

    protected $table = 'units';

    const LESSON_TYPES = [
        'youtube' => 'Youtube Video',
        'vimeo' => 'Vimeo Video',
        'video_file' => 'Video File',
        'video_url' => 'Video URL',
        'document' => 'Document File',
    ];

    const LESSON_DOCUMENT_TYPES = [
        'text' => 'Text File',
        'pdf' => 'PDF File',
        'document' => 'Document File',
        'download_file' => 'Download File',
    ];

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'section_id', 'name', 'slug', 'content', 'short_content',
        'lesson_type', 'lesson_media_url', 'lesson_thumbnail_image', 'lesson_document_type', 'lesson_content', 'time', 'free_lesson', 'is_active'];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }
    public function courseDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function relatedFaqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UnitFaq::class, 'unit_id', 'id');
    }

    public function relatedAttachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UnitAttachment::class, 'unit_id', 'id');
    }
}
