<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const IDENTIFIERS = [
        'admin_marks_course_as_pending',
        'admin_marks_course_as_active',
        'student_purchase_course',
        'student_purchase_bundle',
        'payout_request_approve',
        'admin_course_review_submit',
        'admin_update_system_revenue',
        'admin_allow_publish_course_directly',
        'admin_disallow_publish_course_directly'
    ];

    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = ['instructor_id', 'identifier', 'params', 'mark_as_read', 'read_at'];

    protected $casts = ['params' => 'array', 'read_at' => 'datetime'];
}
