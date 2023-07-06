<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\CourseRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CertificateController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function downloadCertificate($slug): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            $courseUserDetail = $this->courseRepository->getCourseUserDetail($course->id, auth()->user()->id);
            if (isset($courseUserDetail) && $courseUserDetail->progress == 100) {
                if (is_null($courseUserDetail->certificate_date)){
                    $courseUserDetail->update(['certificate_date' => Carbon::now()]);
                }
                $pdf = Pdf::loadView('front-end.course.certificate', compact('course', 'courseUserDetail'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Certificate.pdf');
            }
            return redirect()->route('course_detail', $course->slug);
        }
        return redirect()->route('courses');
    }
}
