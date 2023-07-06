<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Sections;

class SectionRepository implements SectionRepositoryInterface
{
    public function getSections($request)
    {
        $section = Sections::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        });
        $course_id = $request->course_id;
        if ($course_id) {
            $section = $section->where('course_id', $course_id);
        }
        return $section->orderBy('id', 'DESC')->get();
    }

    public function storeSectionData($request)
    {
        $requestData = $request->except("_token");
        foreach ($requestData['name'] as $key => $name) {
            $data = [
                'course_id' => $requestData['course_id'],
                'name' => $name,
                'is_active' => 1,
            ];
            Sections::create($data);
        }
        return true;
    }

    public function getSectionByCourse($course_id)
    {
        $returnData = [];
        if (isset($course_id)) {
            $sections = Sections::where('course_id', $course_id)->get();
            foreach ($sections as $section) {
                $returnData[] = ['id' => $section->id, 'text' => $section->name];
            }
        }
        return $returnData;
    }

    public function getSectionDetail($id)
    {
        return Sections::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('id', $id)->first();
    }

    public function updateSection($request, $id)
    {
        $requestData = $request->all();
        $section = self::getSectionDetail($id);
        $section->update($requestData);
        return true;
    }

    public function updateActiveStatus($request)
    {
        $section = Sections::findOrFail($request->id);
        $section->update(['is_active' => $request->is_active]);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }

    public function getSectionTitles($course_id = null)
    {
        $sections = Sections::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('is_active', 1);
        if (isset($course_id)) {
            $sections = $sections->where('course_id', $course_id);
        }
        return $sections->pluck('name', 'id')->toArray();
    }
}
