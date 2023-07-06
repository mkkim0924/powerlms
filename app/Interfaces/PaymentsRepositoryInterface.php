<?php

namespace App\Interfaces;

interface PaymentsRepositoryInterface
{
    public function getAllPayments($request);

    public function getInstructorPayoutRequests($instructor_id = null);

    public function instructorPendingRequestDetail($instructor_id);

    public function storePayoutRequest($request);

    public function processPayoutRequest($id);

    public function deletePayoutRequest($id);

    public function getOfflinePaymentRequests();

    public function getOfflinePaymentRequestDetail($id);
}
