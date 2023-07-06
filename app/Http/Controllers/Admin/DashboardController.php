<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\PaymentTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $userRepository, $coursesRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $request)
    {
        $data['active_courses'] = Course::byActive()->count();
        $data['pending_review_courses'] = Course::where('course_status', 2)->count();
        $data['total_students'] = User::byActive()->where('type', 0)->count();
        $data['total_instructors'] = User::byActive()->where('type', 1)->count();
        $data['top_courses'] = Course::byActive()->orderBy('total_enrollments', 'DESC')->get()->take(10);

        $new_students_data = CourseUser::selectRaw('Day(created_at) day, COUNT(id) as new_studentsdata')
            ->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->groupBy('day')
            ->orderBy('day')
            ->get()->groupBy('day')->toArray();
        $days_of_last_month = Carbon::now()->month(Carbon::now()->subMonth()->month)->daysInMonth;
        for ($i = 1; $i <= $days_of_last_month; $i++) {
            $chartData['newstudents'][] = isset($new_students_data[$i]) ? $new_students_data[$i][0]['new_studentsdata'] : 0;
        }
        $month_names = getMonthList();
        $chartData['months'] = json_encode(array_values($month_names));
        $students_data = User::selectRaw('MONTH(created_at) month, COUNT(id) as total_studentsdata')
            ->whereyear('created_at', Carbon::now())
            ->groupBy('month')
            ->orderBy('month')
            ->get()->groupBy('month')->toArray();
        $monthlySalesData = PaymentTransaction::whereHas('courseDetails', function ($q) {$q->byUserType();})
            ->selectRaw('MONTH(created_at) month, sum(price) total_earnings, sum(system_revenue) system_earnings')
            ->whereyear('created_at', Carbon::now())
            ->groupBy('month')
            ->orderBy('month')
            ->get()->groupBy('month')->toArray();
        $chartData['totalSales'] = $chartData['platformEarnings'] = [];
        foreach ($month_names as $month_id => $month) {
            $chartData['totalSales'][] = isset($monthlySalesData[$month_id]) ? number_format($monthlySalesData[$month_id][0]['total_earnings'], 2, '.', '') : 0;
            $chartData['platformEarnings'][] = isset($monthlySalesData[$month_id]) ? number_format($monthlySalesData[$month_id][0]['system_earnings'], 2, '.', '') : 0;
            $chartData['totalstudents'][] = isset($students_data[$month_id]) ? $students_data[$month_id][0]['total_studentsdata'] : 0;
        }
        $chartData['new_students'] = json_encode($chartData['newstudents']);
        $chartData['total_students'] = json_encode($chartData['totalstudents']);
        $chartData['total_Sales'] = json_encode($chartData['totalSales']);
        $chartData['platform_earnings'] = json_encode($chartData['platformEarnings']);
        $month_names = json_encode(array_values(getMonthList()));
        return view('admin.dashboard.admin', compact('data', 'chartData', 'month_names'));
    }

    public function instructorDashboard(Request $request): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $students_data = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})
            ->selectRaw('MONTH(created_at) month, COUNT(id) as total_studentsdata')
            ->whereyear('created_at', Carbon::now())
            ->groupBy('month')
            ->orderBy('month')
            ->get()->groupBy('month')->toArray();
        $new_students_data = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})
            ->selectRaw('Day(created_at) day, COUNT(id) as new_studentsdata')
            ->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->groupBy('day')
            ->orderBy('day')
            ->get()->groupBy('day')->toArray();
        $days_of_last_month = Carbon::now()->month(Carbon::now()->subMonth()->month)->daysInMonth;
        for ($i = 1; $i <= $days_of_last_month; $i++) {
            $chartData['newstudents'][] = isset($new_students_data[$i]) ? $new_students_data[$i][0]['new_studentsdata'] : 0;
        }
        $data['total_courses'] = Course::byUserType()->where('course_status', '1')->get()->count();
        $data['free_courses'] = Course::byUserType()->where('is_free', '1')->get()->count();
        $data['paid_courses'] = $data['total_courses'] - $data['free_courses'];
        $data['free_students'] = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})->where('paid_status', 0)->count();
        $data['paid_students'] = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})->where('paid_status', 1)->count();
        $data['total_students'] = $data['free_students'] + $data['paid_students'];
        $data['paid_new_students'] = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})->where('paid_status', 1)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $data['free_new_students'] = CourseUser::whereHas('courseDetails', function ($q) {$q->byUserType();})->where('paid_status', 0)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $data['new_students'] = $data['paid_new_students'] + $data['free_new_students'];
        $data['top_courses'] = Course::byUserType()->byActive()->orderBy('total_enrollments', 'DESC')->get()->take(10);

        $monthlySalesData = PaymentTransaction::whereHas('courseDetails', function ($q) {$q->byUserType();})
            ->selectRaw('MONTH(created_at) month, sum(price) total_earnings, sum(instructor_revenue) total')
            ->whereyear('created_at', Carbon::now())
            ->groupBy('month')
            ->orderBy('month')
            ->get()->groupBy('month')->toArray();
        $month_names = getMonthList();
        $chartData['months'] = json_encode(array_values($month_names));
        $chartData['salesData'] = $chartData['totalSales'] = $chartData['totalstudents'] = [];
        foreach ($month_names as $month_id => $month) {
            $chartData['salesData'][] = isset($monthlySalesData[$month_id]) ? number_format(($monthlySalesData[$month_id][0]['total'] / 1000), 2, '.', '') : 0;
            $chartData['totalSales'][] = isset($monthlySalesData[$month_id]) ? number_format($monthlySalesData[$month_id][0]['total'], 2, '.', '') : 0;
            $chartData['totalstudents'][] = isset($students_data[$month_id]) ? $students_data[$month_id][0]['total_studentsdata'] : 0;
        }
        $chartData['new_students'] = json_encode($chartData['newstudents']);
        $chartData['total_students'] = json_encode($chartData['totalstudents']);
        $chartData['totalSales'] = json_encode($chartData['totalSales']);
        $chartData['salesData'] = json_encode($chartData['salesData']);
        $month_names = json_encode(array_values(getMonthList()));

        return view('admin.dashboard.instructor', compact('data', 'chartData', 'month_names'));
    }

    public function instructorApplicationPage(): \Illuminate\Contracts\View\View | \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\Foundation\Application | \Illuminate\Http\RedirectResponse
    {
            $instructor = auth()->user();
            if ($instructor->instructor_application_status == 1) {
                return redirect()->route('instructor.dashboard');
            }
            return view('admin.instructor_application_form', compact('instructor'));
    }

    public function storeInstructorApplication(Request $request): \Illuminate\Http\RedirectResponse
    {
        $instructor = auth()->user();
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'users');
        }
        $requestData['instructor_application_status'] = User::INSTRUCTOR_APPLICATION_PENDING_STATUS;
        if ($instructor->type == 0) {
            $requestData['type'] = 1;
        }
        $instructor->update($requestData);
        return redirect()->back();
    }
}
