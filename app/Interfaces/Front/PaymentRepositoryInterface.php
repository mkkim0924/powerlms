<?php

namespace App\Interfaces\Front;

interface PaymentRepositoryInterface
{
    public function purchaseCourse($user_id, $course, $paymentResponse, $type);

    public function purchaseBundle($user_id, $bundle, $paymentResponse, $type);

    public function getUserPurchasesHistory();

    public function getPurchaseDetails($id);

}
