<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    const IMAGE_DIMENSION = ['width' => 140, 'height' => 140];

    const TYPES = [0 => 'Student', 1 => 'Instructor'];
    const INSTRUCTOR_STATUS = [0 => 'Pending For Submit Application', 1 => 'Application Approved', 2 => 'Application Review Pending', 3 => 'Application Rejected'];
    const INSTRUCTOR_APPLICATION_PENDING_STATUS = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'social_links','email', 'password', 'type', 'mobile_number', 'address', 'bank_address', 'experience', 'bio', 'bank_name', 'account_number', 'ifsc_routing_number', 'application_reject_reason', 'country', 'zip_code', 'enable_course_review', 'instructor_application_message', 'instructor_application_status', 'instructor_block_status', 'instructor_pending_amount', 'instructor_payout_amount', 'email_verified_at', 'activation_token', 'is_active', 'remember_token', 'image',
            'instructor_zoom_details', 'unread_notifications_count', 'custom_payout_setting_enable', 'system_revenue_percentage', 'stripe_customer_id','intended_url'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'instructor_zoom_details' => 'array'
    ];

    protected $dates = [];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function courseDetail()
    {
        return $this->hasMany(Course::class, "instructor_id", 'id');
    }
    public function ActivecourseCOunt()
    {
        return $this->hasMany(Course::class, "instructor_id", 'id')->where('course_status', 1);
    }

}
