<?php

namespace App\Observers;

use App\Models\InstructorPayoutLog;
use App\Models\User;

class InstructorPayoutObserver
{
    public function created(InstructorPayoutLog $instructorPayoutLog)
    {
        if ($instructorPayoutLog->payment_type == 'credit'){
            $instructor = User::where('id', $instructorPayoutLog->instructor_id)->first();
            $instructor->update(['instructor_pending_amount' => $instructor->instructor_pending_amount + $instructorPayoutLog->price]);
        }
    }

    public function updated(InstructorPayoutLog $instructorPayoutLog)
    {
        if ($instructorPayoutLog->payment_type == 'debit' && $instructorPayoutLog->payout_request_status == 1){
            $instructor = User::where('id', $instructorPayoutLog->instructor_id)->first();
            $instructor->update(['instructor_payout_amount' => $instructor->instructor_payout_amount + $instructorPayoutLog->price]);
            $instructor->update(['instructor_pending_amount' => $instructor->instructor_pending_amount - $instructorPayoutLog->price]);
        }
    }
}
