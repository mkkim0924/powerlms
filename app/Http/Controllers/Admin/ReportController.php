<?php

namespace App\Http\Controllers\Admin;

use App\Events\OfflinePaymentRequestApproveMailEvent;
use App\Events\OfflinePaymentRequestRejectMailEvent;
use App\Exports\ExportReports;
use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\Front\PaymentRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Course;
use App\Models\CourseSurvey;
use App\Models\CourseUser;
use App\Models\CurriculumUser;
use App\Repositories\Front\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $userRepository, $coursesRepository, $paymentsRepository, $frontPaymentRepository;

    public function __construct(UserRepositoryInterface $userRepository, CoursesRepositoryInterface $coursesRepository, PaymentsRepositoryInterface $paymentsRepository, PaymentRepositoryInterface $frontPaymentRepository)
    {
        $this->userRepository = $userRepository;
        $this->coursesRepository = $coursesRepository;
        $this->paymentsRepository = $paymentsRepository;
        $this->frontPaymentRepository = $frontPaymentRepository;
    }

    public function courseReport(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $reports = $this->userRepository->getCourseUsers($request);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.report.course_report', compact('reports', 'courses'));
    }

    public function salesReport(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $payments = $this->paymentsRepository->getAllPayments($request);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.report.sales_report', compact('payments', 'courses'));
    }
    public function courseSurveyReport(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $survey =  DB::select("SELECT `course_surveys`.`id` AS `course_surveys_id`,`course_surveys`.`name` AS `survey_name`,`course_surveys`.`survey_type` AS `survey_type`,`course_surveys`.`created_at` AS `create_date`,`courses`.`name` AS `course_name`,
                                (SELECT COUNT(CASE WHEN `is_skipped` = 1 THEN 1 END ) FROM `user_course_survey` WHERE `survey_id`=`course_surveys`.`id`)  AS `total_skip`,
                                (SELECT COUNT(CASE WHEN `is_skipped` = 0 THEN 1 END ) FROM `user_course_survey` WHERE `survey_id`=`course_surveys`.`id`)  AS `total_submit`
                                FROM `course_surveys`
                                LEFT JOIN `user_course_survey` ON `user_course_survey`.`survey_id` = `course_surveys`.`id`
                                LEFT JOIN `courses` ON `courses`.`id` = `course_surveys`.`course_id`  
                                GROUP BY `course_surveys`.`id`");
        return view('admin.report.course_survey_report', compact('survey'));
    }
    public function courseSurveyReportDetails($id ,Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $survey_data = CourseSurvey::with('surveyQuestions.userCourseSurveyHistory')->where('id',$id)->first();
        return view('admin.report.partials.course_survey_report_detail', compact('survey_data'));
    }

    public function allPayoutRequests(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $payoutRequests = $this->paymentsRepository->getInstructorPayoutRequests();
        return view('admin.user.instructor.payout_requests', compact('payoutRequests'));
    }

    public function instructorPayoutReport(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $instructor = auth()->user();
        $payoutRequests = $this->paymentsRepository->getInstructorPayoutRequests($instructor->id);
        $pendingRequest = $this->paymentsRepository->instructorPendingRequestDetail($instructor->id);
        return view('admin.report.instructor_payout_report', compact('instructor', 'payoutRequests', 'pendingRequest'));
    }

    public function storePayoutRequest(Request $request): \Illuminate\Http\RedirectResponse
    {
        $instructor = auth()->user();
        if ($instructor->instructor_pending_amount >= $request->request_amount) {
            $this->paymentsRepository->storePayoutRequest($request);
            return redirect()->back()->with('success', __('backend.instructor_payouts.flash_message.request_sent'));
        } else {
            return redirect()->back()->with('error', __('backend.instructor_payouts.flash_message.invalid_withdrawal_amount'));
        }
    }

    public function processPayoutRequest($id): \Illuminate\Http\RedirectResponse
    {
        $this->paymentsRepository->processPayoutRequest($id);
        return redirect()->back()->with('success', __('backend.instructor_payouts.flash_message.request_deleted'));
    }

    public function deletePayoutRequest($id): \Illuminate\Http\RedirectResponse
    {
        $this->paymentsRepository->deletePayoutRequest($id);
        return redirect()->back()->with('success', __('backend.instructor_payouts.flash_message.request_deleted'));
    }

    public function getOfflinePaymentRequests(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $offline_requests = $this->paymentsRepository->getOfflinePaymentRequests();
        return view('admin.report.offline_payment_requests', compact('offline_requests'));
    }

    public function updatePaymentRequestStatus($id, $status): \Illuminate\Http\RedirectResponse
    {
        try {
            $offline_request = $this->paymentsRepository->getOfflinePaymentRequestDetail($id);
            if (isset($offline_request)) {
                DB::beginTransaction();
                $emailData = [
                    'name' => $offline_request->userDetails->name,
                    'email' => $offline_request->userDetails->email,
                    'title' => ($offline_request->module_type == 'course') ? $offline_request->courseDetails->name : $offline_request->bundleDetails->name,
                    'amount' => ($offline_request->module_type == 'course') ?
                        formatPrice(($offline_request->courseDetails->discount_flag == 1) ? $offline_request->courseDetails->discounted_price : $offline_request->courseDetails->price) :
                        formatPrice($offline_request->bundleDetails->price),
                ];
                if ($status == 'approve') {
                    if ($offline_request->module_type == 'course') {
                        $this->frontPaymentRepository->purchaseCourse($offline_request->user_id, $offline_request->courseDetails, ['id' => str_random(20)], 'offline_payment');
                    } else {
                        $this->frontPaymentRepository->purchaseBundle($offline_request->user_id, $offline_request->bundleDetails, ['id' => str_random(20)], 'offline_payment');
                    }
                    event(new OfflinePaymentRequestApproveMailEvent($emailData));
                    $message = __('backend.instructor_payouts.flash_message.request_approved');
                } else {
                    event(new OfflinePaymentRequestRejectMailEvent($emailData));
                    $message = __('backend.instructor_payouts.flash_message.request_deleted');
                }
                $offline_request->delete();
                DB::commit();
                return redirect()->back()->with('success', $message);
            }
            return redirect()->back()->with('error', __('global.error.invalid_request'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function courseWiseRevenueReport(Request $request)
    {
        $course_wise_revenue_report = $this->coursesRepository->getCourseWiseRevenue($request);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.report.course_wise_revenue_report', compact('course_wise_revenue_report', 'courses'));
    }


    public function manualCourseEnroll(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $students = $this->userRepository->getActiveStudents();
        return view('admin.report.manual_enroll_form', compact('courses', 'students'));
    }

    public function storeManualCourseEnroll(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        $courseEnrollStatus = CourseUser::where(['user_id' => $requestData['student_id'], 'course_id' => $requestData['course_id']])->exists();
        if (!$courseEnrollStatus) {
            $courseDetails = Course::where('id', $requestData['course_id'])->select('id', 'instructor_id', 'name', 'slug', 'is_free', 'price', 'discount_flag', 'discounted_price', 'expiration_days')->first();
            $this->frontPaymentRepository->purchaseCourse($requestData['student_id'], $courseDetails, ['id' => str_random(20)], 'offline_payment');
            return to_route('admin.course_report')->with('success', __('backend.manual_course_enroll.flash_message.request_store'));
        } else {
            return redirect()->back()->withInput()->with('error', __('backend.manual_course_enroll.flash_message.request_store_rejected'));
        }
    }

    public function exportCourseReport(Request $request)
    {
        $report_data = $this->userRepository->getCourseUsers($request);
        if (count($report_data) == 0) {
            return redirect()->back()->with('error', __('global.error.record_not_found'));
        }
        $alldata = [];
        foreach ($report_data as $data) {
            $created_at = isset($data->userDetails->created_at) ? formatDate($data->userDetails->created_at, 'd-m-y h:i:a') : null;
            $course_enroll_date = isset($data->created_at) ? formatDate($data->created_at, 'd-m-y h:i:a') : null;
            $alldata[] = [
                __('backend.course_report.label.user_name') => $data->userDetails->name ?? "",
                __('backend.course_report.label.name') => $data->courseDetails->name ?? "",
                __('backend.course_report.label.progress') => $data->progress . '%' ?? "0.00%",
                __('backend.course_report.label.user_email') => $data->userDetails->email ?? "",
                __('backend.course_report.label.mobile_number') => isset($data->userDetails->mobile_number) ? $data->userDetails->mobile_number : "",
                __('backend.course_report.label.register_date') => isset($created_at) ? $created_at : "",
                __('backend.course_report.label.course_enroll_date') => isset($course_enroll_date) ? $course_enroll_date : "",
            ];
        }
        $list = array_keys($alldata[0]);
        $data = new ExportReports($alldata, $list);
        return Excel::download($data, __('backend.course_report.export.file_name'));
    }

    public function exportSalesReport(Request $request)
    {
        $report_data = $this->paymentsRepository->getAllPayments($request);
        if (count($report_data) == 0) {
            return redirect()->back()->with('error', __('global.error.record_not_found'));
        }
        $alldata = [];
        $i = 0;
        foreach ($report_data as $data) {
            $created_at = isset($data->userDetails->created_at) ? formatDate($data->userDetails->created_at, 'd-m-y h:i:a') : null;
            $alldata[] = [
                __('backend.sales_report.label.user') => $data->userDetails->name ?? "",
                __('backend.sales_report.label.course_name') => $data->courseDetails->name ?? "",
                __('backend.sales_report.label.price') => isset($data->price) ? formatPrice($data->price) : "",
                __('backend.sales_report.label.instructor_revenue') => isset($data->instructor_revenue) ? formatPrice($data->instructor_revenue) : "",
                __('backend.sales_report.label.payment_date') => isset($data->created_at) ? formatDate($data->created_at, 'd-m-y h:i:a') : "",
                __('backend.sales_report.label.payment_method') => $data->payment_type ?? "",
                __('backend.sales_report.label.user_email') => $data->userDetails->email ?? "",
                __('backend.sales_report.label.mobile_number') => isset($data->userDetails->mobile_number) ? $data->userDetails->mobile_number : "",
                __('backend.sales_report.label.register_date') => isset($created_at) ? $created_at : "",
            ];
            if (request()->user_type == 'admin') {
                $alldata[$i]['Admin Revenue'] = isset($data->system_revenue) ? formatPrice($data->system_revenue) : "";
            }
            $i++;
        }
        $list = array_keys($alldata[0]);
        $data = new ExportReports($alldata, $list);
        return Excel::download($data, __('backend.sales_report.export.file_name'));
    }

    public function exportCourseWiseRevenueReport(Request $request)
    {
        $report_data = $this->coursesRepository->getCourseWiseRevenue($request);
        if (count($report_data) == 0) {
            return redirect()->back()->with('error', __('global.error.record_not_found'));
        }
        $alldata = [];
        foreach ($report_data as $data) {
            $created_at = isset($data['created_at']) ? formatDate($data['created_at'], 'd-m-y h:i:a') : null;
            $alldata[] = [
                __('backend.course_wise_revenue_report.label.course_name') => $data['name'] ?? "",
                __('backend.course_wise_revenue_report.label.instructor_name') => $data['instructor_detail']['name'] ?? "",
                __('backend.course_wise_revenue_report.label.price') => isset($data['price']) ? formatPrice($data['price']) : "",
                __('backend.course_wise_revenue_report.label.system_revenue') => isset($data['payment_transaction_detail'][0]['admin_revenue']) ? formatPrice($data['payment_transaction_detail'][0]['admin_revenue']) : "",
                __('backend.course_wise_revenue_report.label.instructor_revenue') => isset($data['payment_transaction_detail'][0]['instructor_revenue']) ? formatPrice($data['payment_transaction_detail'][0]['instructor_revenue']) : "",
                __('backend.course_wise_revenue_report.label.total_enrollments') => $data['course_user_detail'][0]['total_enrollments'] ?? "",
                __('backend.course_wise_revenue_report.label.course_create_date') => $created_at ?? "",
            ];
        }
        $list = array_keys($alldata[0]);
        $data = new ExportReports($alldata, $list);
        return Excel::download($data, __('backend.course_wise_revenue_report.export.file_name'));
    }

    public function exportInstructorPayoutReport()
    {
        $instructor = auth()->user();
        $report_data = $this->paymentsRepository->getInstructorPayoutRequests($instructor->id);
        if (count($report_data) == 0) {
            return redirect()->back()->with('error', __('global.error.record_not_found'));
        }

        $alldata = [];
        foreach ($report_data as $data) {
            $created_at = isset($data->created_at) ? formatDate($data->created_at, 'd-m-y h:i:a') : null;
            $updated_at = isset($data->updated_at) ? formatDate($data->updated_at, 'd-m-y h:i:a') : null;

            $alldata[] = [
                __('backend.instructor_payout_report.label.payout_amount') => isset($data->price) ? formatPrice($data->price) : "",
                __('backend.instructor_payout_report.label.request_status') => $data->payout_request_status == 1 ? 'Approved' : 'Pending',
                __('backend.instructor_payout_report.label.request_created_date') => isset($created_at) ? $created_at : "",
                __('backend.instructor_payout_report.label.request_approved_date') => $data->payout_request_status == 1 && isset($updated_at) ? $updated_at : "--",
            ];
        }
        $list = array_keys($alldata[0]);
        $data = new ExportReports($alldata, $list);
        return Excel::download($data, __('backend.instructor_payout_report.export.file_name'));
    }

    public function getUserCourseProgressReport($courseUserId)
    {
        $courseUser = CourseUser::with(['courseDetails' => function ($q) {
            $q->select('id', 'name');
        }, 'userDetails' => function ($q) {
            $q->select('id', 'name');
        }])->whereHas('courseDetails', function ($q) {
            $q->byUserType();
        })->where('id', $courseUserId)->first();
        if (isset($courseUser)) {
            $course = $courseUser->courseDetails;
            $student = $courseUser->userDetails;
            $curriculumUsers = CurriculumUser::with(['curriculumDetail'])->where(['user_id' => $courseUser->user_id, 'course_id' => $courseUser->course_id])->get();
            return view('admin.report.course_user_progress', compact('courseUser', 'course', 'student', 'curriculumUsers'));
        } else {
            return abort(404);
        }
    }

    public function quizResult(Request $request): \Illuminate\Http\JsonResponse
    {
        $courseRepository = new CourseRepository();
        $resultData = $courseRepository->getUserQuizResultData($request->quiz_id, $request->student_id);
        $returnHtml = view('admin.report.ajax.quiz_result_html', compact('resultData'))->render();
        return response()->json(['html' => $returnHtml, 'data' => $resultData]);
    }
}
