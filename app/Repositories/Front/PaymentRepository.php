<?php

namespace App\Repositories\Front;

use App\Interfaces\Front\PaymentRepositoryInterface;
use App\Models\BundleUser;
use App\Models\CourseUser;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function purchaseCourse($user_id, $course, $paymentResponse, $type): bool
    {
        $user = User::where('id', $user_id)->select('id', 'name', 'email')->first();
        $amount = ($course->discount_flag == 1) ? $course->discounted_price : $course->price;
        $courseUser = CourseUser::create([
            'course_id' => $course->id,
            'user_id' => $user_id,
            'paid_status' => ($course->is_free == 0) ? 1 : 0,
            'payment_completed_at' => ($course->is_free == 0) ? Carbon::now() : null,
            'expire_at' => isset($course->expiration_days) ? Carbon::now()->addDays($course->expiration_days) : null,
        ]);
        if ($course->is_free == 0){
            $priceData = calculateEarnings($amount, $course->instructorDetail->system_revenue_percentage ?? null);
            PaymentTransaction::create([
                'course_id' => $course->id,
                'user_id' => $user_id,
                'module_type' => 'course',
                'module_user_id' => $courseUser->id,
                'price' => $amount,
                'system_revenue' => $priceData['system_revenue'],
                'system_revenue_percentage' => $priceData['system_revenue_percentage'],
                'tax_percentage' => $priceData['tax_value_percentage'],
                'system_revenue_tax_price' => $priceData['system_revenue_tax_value'],
                'tax_price' => $priceData['total_tax'],
                'instructor_revenue' => $priceData['instructor_total_earning'],
                'payment_type' => $type,
                'payment_id' => $paymentResponse['id'],
                'payment_response' => json_encode($paymentResponse),
            ]);
            $notificationService = new NotificationService();
            $notificationService->store(
                $course->instructor_id,
                'student_purchase_course',
                ['student' => $user->name, 'id' => $course->id, 'name' => $course->name, 'amount' => $amount]
            );
        }
        return true;
    }

    public function purchaseBundle($user_id, $bundle, $paymentResponse, $type): bool
    {
        $user = User::where('id', $user_id)->select('id', 'name', 'email')->first();
        $bundleUser = BundleUser::create([
            'bundle_id' => $bundle->id,
            'user_id' => $user_id,
        ]);
        foreach ($bundle->relatedCourses as $bundleCourses){
            $courseUser = CourseUser::where(['course_id' => $bundleCourses->course_id, 'user_id' => $user_id])->first();
            if (is_null($courseUser)){
                CourseUser::create([
                    'course_id' => $bundleCourses->course_id,
                    'user_id' => $user_id,
                    'bundle_user_id' => $bundleUser->id,
                    'paid_status' => 1,
                    'payment_completed_at' => Carbon::now(),
                    'expire_at' => isset($bundleCourses->courseDetails->expiration_days) ? Carbon::now()->addDays($bundleCourses->courseDetails->expiration_days) : null
                ]);
            }
        }
        $priceData = calculateEarnings($bundle->price, $bundle->instructorDetail->system_revenue_percentage ?? null);
        PaymentTransaction::create([
            'course_id' => $bundle->id,
            'user_id' => $user_id,
            'module_type' => 'bundle',
            'module_user_id' => $bundleUser->id,
            'price' => $bundle->price,
            'system_revenue' => $priceData['system_revenue'],
            'system_revenue_percentage' => $priceData['system_revenue_percentage'],
            'tax_percentage' => $priceData['tax_value_percentage'],
            'system_revenue_tax_price' => $priceData['system_revenue_tax_value'],
            'tax_price' => $priceData['total_tax'],
            'instructor_revenue' => $priceData['instructor_total_earning'],
            'payment_type' => $type,
            'payment_id' => $paymentResponse['id'],
            'payment_response' => json_encode($paymentResponse),
        ]);
        $notificationService = new NotificationService();
        $notificationService->store(
            $bundle->instructor_id,
            'student_purchase_bundle',
            ['student' => $user->name, 'id' => $bundle->id, 'name' => $bundle->name, 'amount' => $bundle->price]
        );
        return true;
    }

    // Purchase
    public function getUserPurchasesHistory()
    {
        return PaymentTransaction::where('user_id', request()->user_id)->orderBy('id', 'DESC')->get();
    }

    public function getPurchaseDetails($id)
    {
        return PaymentTransaction::where('user_id', request()->user_id)->where('id', $id)->get();
    }
}
