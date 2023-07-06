<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $coursesRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $request)
    {
        $requestData = $request->all();
        $courses = $this->coursesRepository->getCourseTitles();

        $query = Review::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        });

        //for filter
        if (!empty($request->review_date)) {
            $dateArray = (explode(' - ', $request->review_date));
            $startDate = isset($dateArray[0]) ? date('Y-m-d', strtotime($dateArray[0])) : null;
            $endDate = isset($dateArray[1]) ? date('Y-m-d', strtotime($dateArray[1])) : null;
        } elseif(!in_array('review_date', array_keys($requestData))) {
            $startDate = Carbon::now()->subDays(6)->toDateString();
            $endDate = Carbon::now()->toDateString();
        }
        if (isset($startDate) && isset($endDate)) {
            $query = $query->whereBetween('created_at', array($startDate . ' 00:00:00', $endDate . ' 23:59:59'));
        }
        if (!empty($request->course_id)) {
            $query = $query->where('course_id', $request->course_id);
        }
        if (!empty($request->rating)) {
            $query = $query->where('rating', $request->rating);
        }

        $review_data = $query->get();
        return view('admin.reviews.index', compact('review_data', 'courses'));
    }
}
