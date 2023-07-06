<?php

namespace App\Observers;

use App\Models\Bundle;
use App\Models\BundleUser;

class BundleUserObserver
{
    public function created(BundleUser $bundleUser)
    {
        Bundle::where('id', $bundleUser->bundle_id)->increment('total_enrollments');
    }
}
