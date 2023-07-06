<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\FaqsRepositoryInterface;
use App\Models\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{

    protected $coursesRepository, $faqsRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, FaqsRepositoryInterface $faqsRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->faqsRepository = $faqsRepository;
    }

    public function index(Request $request)
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $faqs = $this->faqsRepository->getFaqs($request);
        return view('admin.faqs.index', compact('courses', 'faqs'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.faqs.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->faqsRepository->storeFaqData($request);
        $this->coursesRepository->getCourseTitles($request->course_id);
        return redirect()->route(request()->user_type.'.faqs')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $faqs = $this->faqsRepository->getFaqDetail($id);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.faqs.edit', compact('faqs', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $this->faqsRepository->updateFaqData($request, $id);
        return redirect()->route(request()->user_type.'.faqs')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        Faqs::destroy($id);
        return redirect()->route(request()->user_type.'.faqs');
    }

    public function getFaqsByCourse($course_id)
    {
        $data = $this->faqsRepository->getFaqsByCourse($course_id);
        $html = view('admin.faqs.index', compact('data'))->render();
        return response()->json(['status' => true, 'html' => $html]);
    }

}
