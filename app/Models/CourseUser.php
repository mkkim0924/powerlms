<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $table = 'course_users';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'user_id', 'bundle_user_id', 'progress', 'paid_status', 'payment_completed_at', 'certificate_date', 'subscription_payment', 'access_sections_count','expire_at'];

    public function courseDetails()
    {
        return $this->hasOne(Course::class, 'id', 'course_id')->withTrashed();
    }

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }

    public function transactionDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PaymentTransaction::class, 'module_user_id', 'id');
    }
}
