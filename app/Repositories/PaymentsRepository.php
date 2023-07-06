<?php

namespace App\Repositories;

use App\Interfaces\PaymentsRepositoryInterface;
use App\Models\InstructorPayoutLog;
use App\Models\OfflinePaymentRequest;
use App\Models\PaymentTransaction;
use App\Services\NotificationService;
use Carbon\Carbon;

class PaymentsRepository implements PaymentsRepositoryInterface
{
    public function getAllPayments($request)
    {
        $requestData = $request->all();
        $payments = PaymentTransaction::whereHas('courseDetails', function ($q) {
            $q->byUserType();
        });
        if ($request->course_id) {
            $payments = $payments->where('course_id', $request->course_id);
        }
        if ($request->purchase_date) {
            $dateArray = (explode(' - ', $request->purchase_date));
            $startDate = isset($dateArray[0]) ? date('Y-m-d', strtotime($dateArray[0])) : null;
            $endDate = isset($dateArray[1]) ? date('Y-m-d', strtotime($dateArray[1])) : null;
        } elseif(!in_array('purchase_date', array_keys($requestData))) {
            $startDate = Carbon::now()->subDays(6)->toDateString();
            $endDate = Carbon::now()->toDateString();
        }
        if (isset($startDate) && isset($endDate)){
            $payments = $payments->whereBetween('created_at', array($startDate . ' 00:00:00', $endDate . ' 23:59:59'));
        }
        $search = $request->search;
        if ($search) {
            $payments = $payments->whereHas('userDetails', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        return $payments->orderBy('id', 'DESC')->get();
    }

    public function getInstructorPayoutRequests($instructor_id = null): \Illuminate\Database\Eloquent\Collection|array
    {
        $query = InstructorPayoutLog::query();
        if (isset($instructor_id)) {
            $query = $query->where('instructor_id', $instructor_id);
        }
        return $query->where('payment_type', 'debit')->orderBy('id', 'DESC')->get();
    }

    public function instructorPendingRequestDetail($instructor_id)
    {
        return InstructorPayoutLog::where('instructor_id', $instructor_id)->where('payment_type', 'debit')->where('payout_request_status', 0)->first();
    }

    public function storePayoutRequest($request): bool
    {
        InstructorPayoutLog::create([
            'instructor_id' => $request->user_id,
            'payment_type' => 'debit',
            'price' => $request->request_amount,
            'payout_request_status' => 0,
        ]);
        return true;
    }

    public function processPayoutRequest($id): bool
    {
        $payoutRequest = InstructorPayoutLog::where('id', $id)->first();
        $payoutRequest->update(['payout_request_status' => 1]);
        $notificationService = new NotificationService();
        $notificationService->store(
            $payoutRequest->instructor_id,
            'payout_request_approve',
            ['amount' => $payoutRequest->price]
        );
        return true;
    }

    public function deletePayoutRequest($id): bool
    {
        InstructorPayoutLog::destroy($id);
        return true;
    }

    public function getOfflinePaymentRequests(): \Illuminate\Database\Eloquent\Collection
    {
        return OfflinePaymentRequest::all();
    }

    public function getOfflinePaymentRequestDetail($id)
    {
        return OfflinePaymentRequest::find($id);
    }
}
