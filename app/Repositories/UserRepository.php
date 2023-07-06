<?php

namespace App\Repositories;

use App\Events\InstructorApplicationApproveEvent;
use App\Events\InstructorCreateMailEvent;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Admins;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAllStudents()
    {
        return User::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
    }

    public function getAllInstructor()
    {
        return User::orderBy('id', 'DESC')->where('instructor_application_status', 1)->where('type', 1)->get();
    }

    public function getAllInstructorApplications()
    {
        return User::where('type', 1)->whereIn('instructor_application_status', [2, 3])->get();
    }

    public function updateApplicationStatus($user_id, $status): bool
    {
        if ($status == 'delete') {
            User::where('id', $user_id)->update(['instructor_block_status' => 1, 'type' => 0, 'instructor_application_status' => 3]);
            Course::where('instructor_id', $user_id)->delete();
        } else {
            User::where('id', $user_id)->update(['instructor_application_status' => 1]);
            $user = User::where('id', $user_id)->first();
            event(new InstructorApplicationApproveEvent($user));
        }
        return true;
    }

    public function getInstructorNames()
    {
        return User::where('type', 1)->where('is_active', 1)->where('instructor_application_status', 1)->pluck('name', 'id')->toArray();
    }

    public function updateProfile($request)
    {
        $requestData = $request->all();
        $currentUser = auth()->user();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'users/', $currentUser->image);
        }
        $social_links = [];
        $social_links = [
            'facebook' => $requestData['facebook_link'] ?? null,
            'linkedin' => $requestData['linkedin_link'] ?? null,
            'twitter' => $requestData['twitter_link'] ?? null,
            'website' => $requestData['website_link'] ?? null,
        ];
        $requestData['social_links'] = json_encode($social_links);
        $currentUser->update($requestData);
        return true;
    }

    public function getUsersDetails($id)
    {
        return User::findOrFail($id);
    }

    public function storeInstructor($request): array
    {
        DB::beginTransaction();
        try{
            $requestData = $request->all();
            $requestData['is_active'] = 1;
            $requestData['type'] = 1;
            $requestData['instructor_application_status'] = 1;
            if (isset($requestData['image'])) {
                $requestData['image'] = uploadFile($requestData['image'], 'users', null, User::IMAGE_DIMENSION);
            }
            $user = User::create($requestData);
            $emailData = array(
                "name" => $requestData['name'],
                "email" => $requestData['email'],
                "password" => $requestData['password'],
            );
            event(new InstructorCreateMailEvent($emailData));
            $admin = Admins::where('email', '=', $requestData['email'])->first();
            if (isset($admin)) {
                $admin->update(['instructor_id' => $user['id']]);
            }
            DB::commit();
            return ['status' => true];
        }catch (\Exception $e){
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateUser($request, $id): bool
    {
        $user = self::getUsersDetails($id);
        $requestData = $request->all();
        $requestData['enable_course_review'] = isset($requestData['enable_course_review']) ? 1 : 0;
        $requestData['custom_payout_setting_enable'] = isset($requestData['custom_payout_setting_enable']) ? 1 : 0;
        $requestData['system_revenue_percentage'] = ($requestData['custom_payout_setting_enable'] == 1) ? $requestData['system_revenue_percentage'] : null;
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'users', $user->image, User::IMAGE_DIMENSION);
        }
        $user->update($requestData);

        $notificationService = new NotificationService();
        if (in_array('enable_course_review', array_keys($user->getChanges()))) {
            $notificationService->store($id, ($requestData['enable_course_review'] == 0) ? 'admin_allow_publish_course_directly' : 'admin_disallow_publish_course_directly');
        }
        if (in_array('system_revenue_percentage', array_keys($user->getChanges()))) {
            $notificationService->store(
                $id, 'admin_update_system_revenue',
                ['revenue' => ($requestData['custom_payout_setting_enable'] == 1) ? $requestData['system_revenue_percentage'] : config('system_revenue_percentage')]
            );
        }
        return true;
    }

    public function delete($id)
    {
        User::destroy($id);
        return true;
    }

    public function getCourseUserDetail($id)
    {
        return CourseUser::where('user_id', $id)->get();
    }

    public function getActiveStudents()
    {
        return User::where('type', 0)->byActive()->pluck('email', 'id')->toArray();
    }

    public function getCourseUsers($request)
    {
        $requestData = $request->all();
        $courseUser = CourseUser::whereHas('courseDetails', function ($q) {
            $q->byUserType();
        });
        if ($request->course_id) {
            $courseUser = $courseUser->where('course_id', $request->course_id);
        }
        if ($request->enroll_date) {
            $dateArray = (explode(' - ', $request->enroll_date));
            $startDate = isset($dateArray[0]) ? date('Y-m-d', strtotime($dateArray[0])) : null;
            $endDate = isset($dateArray[1]) ? date('Y-m-d', strtotime($dateArray[1])) : null;
        } elseif(!in_array('enroll_date', array_keys($requestData))) {
            $startDate = Carbon::now()->subDays(6)->toDateString();
            $endDate = Carbon::now()->toDateString();
        }
        if (isset($startDate) && isset($endDate)) {
            $courseUser = $courseUser->whereBetween('created_at', array($startDate . ' 00:00:00', $endDate . ' 23:59:59'));
        }
        if ($request->search) {
            $search = $request->search;
            $courseUser = $courseUser->whereHas('courseDetails', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        return $courseUser->orderBy('id', 'DESC')->get();
    }
}
