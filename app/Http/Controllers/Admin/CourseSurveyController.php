<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Models\Course;
use App\Models\CourseSurvey;
use App\Models\CourseSurveyQuestion;
use App\Models\CourseSurveyQuestionOptions;
use Illuminate\Http\Request;

class CourseSurveyController extends Controller
{
    protected $coursesRepository, $quizRepository, $sectionRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository,)
    {
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $request)
    {
        //for fillters
        $query = CourseSurvey::whereHas('courseDetails', function($q){ $q->byUserType(); });
        if (isset($request['course_id']) && $request['course_id'] != '') {
            $query = $query->where('course_id',$request['course_id']);
        }
        if(!empty($request['type'])){
            $query = $query->where('survey_type',$request['type']);
        }
        if(isset($request['status']) && $request['status'] != ''){
            $query = $query->where('is_active',$request['status']);
        }
        $course_survey_data = $query->get();
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.course_surveys.index',compact('course_survey_data','courses'));
    }
    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.course_surveys.create',compact('courses'));
    }
    public function store(Request $request)
    {
        $request_data = $request->all();
        $course_exist = CourseSurvey::where('course_id',$request_data['course_id'])->where('survey_type',$request_data['survey_type'])->get();
        if (!isset($course_exist[0])) {
            $request_data['is_skippable'] = isset($request_data['is_skippable']) ? 1 : 0 ;
            $new_data = CourseSurvey::Create($request_data);
            return to_route('instructor.survey.questions',$new_data['id']);
        }else{
            return redirect()->back()->with('error','Survey Already Exist for This Course');
        }
    }
    public function edit($id)
    {
        $data = CourseSurvey::findOrFail($id);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.course_surveys.edit',compact('data','courses'));
    }
    public function update(Request $request, $id)
    {
        $old_data = CourseSurvey::findOrFail($id);
        $request_data = $request->all();
        if(isset($request_data['course_id']) && isset($request_data['survey_type'])){
            $course_exist = CourseSurvey::where('course_id',$request_data['course_id'])->where('survey_type',$request_data['survey_type'])->get();
            $request_data['is_skippable'] = isset($request_data['is_skippable']) ? 1 : 0 ;
            if (!isset($course_exist[0]) || (isset($course_exist[0]['id']) && $course_exist[0]['id'] == $request_data['id'])) {
                $old_data->update($request_data);
                return to_route('instructor.surveys');
            }else{
                return redirect()->back()->with('error','Survey Already Exist for This Course');
            }
        }else{
            return redirect()->back()->with('error',"Something went wrong");
        }
    }
    public function delete($id)
    {
        CourseSurvey::findOrFail($id)->delete();
        return to_route('instructor.surveys');
    }

    public function getSurveyQuestions($survey_id)
    {
        $questions = CourseSurveyQuestion::where('survey_id',$survey_id)->get();
        $survey = CourseSurvey::findOrFail($survey_id);
        return view('admin.course_survey_questions.index',compact('questions','survey'));
    }
    public function createSurveyQuestion($survey_id)
    {
        return view('admin.course_survey_questions.create',compact('survey_id'));
    }
    public function storeSurveyQuestion(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        try{
            $request_data = $request->all();
            $survey_id = $request_data['survey_id'] ?? '';
            $corse_survey_que = CourseSurveyQuestion::Create($request_data);
            if (($request_data['type'] == 'multiple_choice') || ($request_data['type'] == 'single_choice')){
                foreach ($request_data['options_data'] as $key => $value) {
                    $option_id = $key ?? '';
                    $content = $value ?? '';
                    $option_data[] = [
                        'survey_id' => $survey_id,
                        'survey_question_id' => $corse_survey_que['id'] ?? '',
                        'option_id' => $option_id,
                        'content' => $content,
                    ];
                }
                CourseSurveyQuestionOptions::insert($option_data);
            }
            return to_route('instructor.survey.questions',$survey_id)->with('success', 'Data Created Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Something went wrong");
        }
    }
    public function editSurveyQuestion($id)
    {
        $data = CourseSurveyQuestion::findOrFail($id);
        $option_data = CourseSurveyQuestionOptions::where('survey_question_id',$id)->get();
        $survey_id = $data->survey_id;
        return view('admin.course_survey_questions.edit',compact('data','option_data','survey_id'));
    }
    public function updateSurveyQuestion(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        try{
            $old_data = CourseSurveyQuestion::findOrFail($id);
            $request_data = $request->all();
            $survey_id = $request_data['survey_id'] ?? '';
            $old_data->update($request_data);

            CourseSurveyQuestionOptions::where('survey_question_id',$id)->where('survey_id',$survey_id)->delete();
            if (($request_data['type'] == 'multiple_choice') || ($request_data['type'] == 'single_choice')){
                foreach ($request_data['options_data'] as $key => $value) {
                    $option_id = $key ?? '';
                    $content = $value ?? '';
                    $option_data[] = [
                        'survey_id' => $survey_id,
                        'survey_question_id' => $old_data['id'] ?? '',
                        'option_id' => $option_id,
                        'content' => $content,
                    ];
                }
                CourseSurveyQuestionOptions::insert($option_data);
            }
            return to_route('instructor.survey.questions',$survey_id);
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Something went wrong");
        }
    }
    public function deleteSurveyQuestion($id)
    {
        CourseSurveyQuestion::findOrFail($id)->delete();
        CourseSurveyQuestionOptions::where('survey_question_id',$id)->delete();
        return redirect()->back();
    }
    public function updateStatus(Request $request)
    {
        $survey = CourseSurvey::findOrFail($request->id);
        $survey->update(['is_active' => $request->is_active]);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }
}
