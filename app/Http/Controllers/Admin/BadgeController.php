<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BadgeRepositoryInterface;
use App\Interfaces\CoursesRepositoryInterface;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    protected $badgeRepository, $coursesRepository;
    public function __construct(badgeRepositoryInterface $badgeRepository, CoursesRepositoryInterface $coursesRepository)
    {
        $this->badgeRepository = $badgeRepository;
        $this->coursesRepository = $coursesRepository;
    }

    public function index()
    {
        $badges = $this->badgeRepository->getAllBadges();
        return view('admin.badge.index', compact('badges'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.badge.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->badgeRepository->storeBadgesData($request);
        return redirect()->route('admin.badge')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $badges = $this->badgeRepository->getBadgesDetails($id);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.badge.edit', compact('badges', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $this->badgeRepository->updateBadgesData($request, $id);
        return redirect()->route('admin.badge')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->badgeRepository->delete($id);
        return redirect()->route('admin.badge');
    }
}
