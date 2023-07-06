<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransaction extends Model
{
    use SoftDeletes;

    protected $table = 'payment_transactions';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'course_id', 'module_type', 'module_user_id', 'price', 'system_revenue', 'system_revenue_percentage', 'tax_percentage', 'system_revenue_tax_price', 'tax_price', 'instructor_revenue', 'payment_type', 'payment_id', 'payment_response'];

    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, "id", 'course_id')->withTrashed();
    }

    public function bundleDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Bundle::class, "id", 'course_id');
    }

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
