<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfflinePaymentRequest extends Model
{
    protected $table = 'offline_payment_requests';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'module_id', 'module_type'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function courseDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Course::class, 'id', 'module_id');
    }

    public function bundleDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Bundle::class, 'id', 'module_id');
    }
}
