<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    const IMAGE_DIMENSION = ['width' => 800, 'height' => 600];
    const THUMBNAIL_IMAGE_DIMENSION = ['width' => 800, 'height' => 600];

    const LEVELS = [
        'Beginner' => "Beginner",
        'Advanced' => "Advanced",
        'Intermediate' => "Intermediate",
    ];
    const VIDEO_PROVIDER = [
        'youtube' => "Youtube",
        'vimeo' => "Vimeo",
        'html5' => "HTML5",
        'video_file' => "Video File",
    ];
    const STATUSES = [
        '0' => "Pending",
        '1' => "Active",
        '2' => "Submit For Review",
        '3' => "Review Completed",
        '4' => "Rejected",
        '5' => "In Draft",
    ];

    protected $table = 'courses';

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'instructor_id',
        'stripe_price_id',
        'badge_id',
        'name',
        'slug',
        'tiny_description',
        'content',
        'requirements',
        'what_you_will_learn_points',
        'who_this_course_is_for_points',
        'image',
        'is_free',
        'price',
        'discount_flag',
        'discounted_price',
        'subscription_flag',
        'subscription_price',
        'subscription_interval',
        'subscription_interval_count',
        'subscription_installment_count',
        'intro_video_provider',
        'intro_video_url',
        'intro_thumbnail_image',
        'time',
        'course_level',
        'related_courses',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_script',
        'welcome_message',
        'congratulation_message',
        'average_rating',
        'total_reviews',
        'total_enrollments',
        'course_status',
        'expiration_days',
        'has_pending_comments',
    ];

    protected $casts = ['related_courses' => 'array', 'what_you_will_learn_points' => 'array', 'who_this_course_is_for_points' => 'array'];

    public function scopeByActive($q)
    {
        $q->where('course_status', 1)->whereHas('instructorDetail');
    }

    public function scopeByUserType($q)
    {
        if (request()->user_type == 'instructor') {
            $q->where('instructor_id', request()->user_id);
        } elseif (request()->user_type == 'admin') {
            $q->where('course_status', '!=', 5);
        }
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    public function setRequirementsAttribute($value)
    {
        $this->attributes['requirements'] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    public function categoryDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function badgeDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Badge::class, 'id', 'badge_id');
    }

    public function instructorDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function relatedFaqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Faqs::class, 'course_id', 'id');
    }
    public function relatedInterviewQuestions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseInterviewQuestion::class, 'course_id', 'id');
    }

    public function relatedCurriculumSections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Curriculum::class, 'course_id', 'id')->where('curriculum_type', 'section')->where('is_active', 1);
    }

    public function relatedCurriculumLessons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Curriculum::class, 'course_id', 'id')->where('curriculum_type', '!=', 'section')->where('is_active', 1);
    }
    public function paymentTransactionDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'course_id', 'id');
    }
    public function courseUserDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseUser::class, 'course_id', 'id');
    }
}
