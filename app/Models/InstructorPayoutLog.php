<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorPayoutLog extends Model
{
    use SoftDeletes;

    protected $table = 'instructor_payout_logs';

    protected $primaryKey = 'id';

    protected $fillable = ['instructor_id', 'course_id', 'payment_transaction_id', 'payment_type', 'price', 'payout_request_status'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, "id", 'instructor_id');
    }
    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, "id", 'course_id');
    }
}
