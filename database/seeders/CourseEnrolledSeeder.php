<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\CurriculumUser;
use App\Models\InstructorPayoutLog;
use App\Models\Notification;
use App\Models\PaymentTransaction;
use App\Models\QuestionAnswerUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseEnrolledSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseUser::truncate();
        PaymentTransaction::truncate();
        InstructorPayoutLog::truncate();
        Notification::truncate();
        CurriculumUser::truncate();
        QuestionAnswerUser::truncate();
        $user_data = User::where('type', 0)->pluck('id', 'name')->toArray();
        $start_date = Carbon::now()->subYear();
        $end_date = Carbon::now();
        foreach ($user_data as $name => $id) {
            if ($id == 5){
                $courses = [1,2,3,5];
                foreach ($courses as $course_id){
                    $this->enrollCourse($course_id, $id, $name, $start_date, $end_date, $course_id == 1 || $course_id == 2 ? 100.00 : 00.00);
                }
            }else{
                $this->enrollCourse(rand(1, 20), $id, $name, $start_date, $end_date);
            }
        }
    }

    public function enrollCourse($course_id, $user_id, $user_name, $start_date, $end_date, $progress = 00.00)
    {
        $course_data = Course::byActive()->select('id','expiration_days', 'is_free', 'total_enrollments', 'instructor_id', 'name', 'slug', 'price', 'discount_flag', 'discounted_price', 'subscription_price', 'subscription_installment_count')->where('id', $course_id)->first();
        $priceData = calculateEarnings($course_data->price, config('system_revenue_percentage'));
        if ($course_data->is_free == 1) {
            $paid_status = 0;
        } else {
            $paid_status = 1;
        };

        $date = randomDateInRange($start_date, $end_date);
        $courseUser = CourseUser::create([
            'course_id' => $course_data->id,
            'user_id' => $user_id,
            'progress' => $progress,
            'paid_status' => $paid_status,
            'payment_completed_at' => ($course_data->is_free == 0) ? $date : null,
            'expire_at' => isset($course_data->expiration_days) ? Carbon::now()->addDays($course_data->expiration_days) : null,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if ($course_data->is_free == 0) {
            $payment_transactions = [
                'course_id' => $course_data->id,
                'user_id' => $user_id,
                'module_type' => 'course',
                'module_user_id' => $courseUser->id,
                'price' => $course_data->price,
                'system_revenue' => $priceData['system_revenue'],
                'system_revenue_percentage' => $priceData['system_revenue_percentage'],
                'tax_percentage' => $priceData['tax_value_percentage'],
                'system_revenue_tax_price' => $priceData['system_revenue_tax_value'],
                'tax_price' => $priceData['total_tax'],
                'instructor_revenue' => $priceData['instructor_total_earning'],
                'payment_type' => 'razorpay',
                'payment_id' => 'pay_' . str_random(14),
                'payment_response' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ];
            PaymentTransaction::create($payment_transactions);
            Notification::create([
                'instructor_id' => $course_data->instructor_id,
                'identifier' => 'student_purchase_course',
                'params' => json_encode(['student' => $user_name, 'id' => $course_data->id, 'name' => $course_data->name, 'amount' => $course_data->price]),
                'mark_as_read' => 0,
                'read_at' => null,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
        if ($progress == 100.00) {
            foreach ($course_data->relatedCurriculumLessons as $key => $value) {
                CurriculumUser::Create([
                    'user_id' => $user_id,
                    'course_id' => $course_data->id,
                    'curriculum_id' => $value->id,
                    'module_id' => $value->section_id,
                    'module_type' => $value->curriculum_type,
                    'is_completed' => 1,
                ]);
                if ($value->curriculum_type == 'quiz') {
                    QuestionAnswerUser::where([
                        'user_id' => $user_id,
                        'quiz_id' => $value->curriculum_list_id,
                    ])->delete();
                    foreach ($value->quizDetail->relatedQuestions as $question) {
                        $available_options = count($question->relatedOptions);
                        foreach ($question->relatedOptions as $value) {
                            if ($value->is_correct_answer == 1) {
                                $correct_ans = $value->option_id;
                            }    
                        }
                        if ($available_options > 0) {
                            $user_answer = rand(1,$available_options);
                        }
                        $answerData = [
                            'user_id' => $user_id,
                            'course_id' => $course_data->id,
                            'quiz_id' => $question->quiz_id,
                            'question_id' => $question->id,
                            'user_answer' => $user_answer,
                            'is_correct_answer' => $correct_ans == $user_answer ? 1 : 0,
                        ];
                        QuestionAnswerUser::create($answerData);
                    }
                }
            }
        }
    }
}
