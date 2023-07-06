<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    protected $table = 'subscription_history';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'course_id', 'course_user_id', 'subscription_id', 'plan_id', 'stripe_customer_id', 'subscription_start_date', 'subscription_end_date', 'subscription_price', 'subscription_installment_count', 'status'];

    protected $casts = ['subscription_start_date' => 'datetime', 'subscription_end_date' => 'datetime'];

    public function courseUserDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseUser::class, 'id', 'course_user_id');
    }
}
