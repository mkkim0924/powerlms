<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\SectionRepositoryInterface;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    protected $coursesRepository, $quizRepository, $sectionRepository;

    public function __construct(QuizRepositoryInterface $quizRepository, CoursesRepositoryInterface $coursesRepository, SectionRepositoryInterface $sectionRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->quizRepository = $quizRepository;
        $this->sectionRepository = $sectionRepository;
    }
    public function index(Request $request)
    {
        $quizList = $this->quizRepository->getQuiz($request);
        $courses = $this->coursesRepository->getCourseTitles();
        $sections = $request->course_id ? $this->sectionRepository->getSectionTitles($request->course_id) : [];
        return view('admin.quiz.index', compact('quizList', 'courses', 'sections'));
    }
    public function create(Request $request)
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $sections = $request->course_id ? $this->sectionRepository->getSectionTitles($request->course_id) : [];
        return view('admin.quiz.create', compact('courses', 'sections'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $response = $this->quizRepository->storeQuizData($request);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.quiz')->with('success', __('global.flash_message.data_created_successfully'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function edit($id)
    {
        $quiz = $this->quizRepository->getQuizDetails($id);
        if (isset($quiz)) {
            $courses = $this->coursesRepository->getCourseTitles();
            $sections = $this->sectionRepository->getSectionTitles($quiz->course_id);
            return view('admin.quiz.edit', compact('quiz', 'courses', 'sections'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->quizRepository->updateQuiz($request, $id);
        return redirect()->route(request()->user_type . '.quiz')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->quizRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        Quiz::destroy($id);
        return redirect()->route(request()->user_type . '.quiz');
    }

    /*Question Module*/
    public function getQuizQuestions($quiz_id): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $quiz = $this->quizRepository->getQuizDetails($quiz_id);
        if (isset($quiz)) {
            $questions = $this->quizRepository->getQuizQuestions($quiz_id);
            return view('admin.quiz_questions.index', compact('questions', 'quiz'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function createQuizQuestion($quiz_id): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        return view('admin.quiz_questions.create', compact('quiz_id'));
    }

    public function storeQuizQuestion(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required'
        ], [
            'title.required' => __('validation.required', ['attribute' => strtolower(__('backend.quiz_questions.label.question_title'))])
        ]);
        if (empty(strip_tags($request->title))) {
            return redirect()->back()->with('error', __('validation.required', ['attribute' => strtolower(__('backend.quiz_questions.label.question_title'))]));
        }
        $response = $this->quizRepository->storeQuizQuestion($request);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.quiz.questions', $request->quiz_id)->with('success', __('global.flash_message.data_created_successfully'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function editQuizQuestion($que_id): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $question = $this->quizRepository->getQueDetails($que_id);
        if (isset($question)) {
            $quiz_id = $question->quiz_id;
            return view('admin.quiz_questions.edit', compact('question', 'quiz_id'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function updateQuizQuestion(Request $request, $que_id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required'
        ], [
            'title.required' => __('validation.required', ['attribute' => strtolower(__('backend.quiz_questions.label.question_title'))])
        ]);
        if (empty(strip_tags($request->title))) {
            return redirect()->back()->with('error', __('validation.required', ['attribute' => strtolower(__('backend.quiz_questions.label.question_title'))]));
        }
        $response = $this->quizRepository->updateQuizQuestion($request, $que_id);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.quiz.questions', $request->quiz_id)->with('success', __('global.flash_message.data_updated_successfully'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function deleteQuizQuestion($que_id): \Illuminate\Http\RedirectResponse
    {
        $this->quizRepository->deleteQuizQuestion($que_id);
        return redirect()->back()->with('success', __('global.flash_message.data_deleted_successfully'));
    }
}
