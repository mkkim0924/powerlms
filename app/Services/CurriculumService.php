<?php

namespace App\Services;


use App\Models\Course;
use App\Models\Curriculum;

class CurriculumService
{
    public function store($curriculum_type, $curriculum)
    {
        Curriculum::create([
            'course_id' => $curriculum->course_id,
            'section_id' => ($curriculum_type == 'section') ? $curriculum->id : $curriculum->section_id,
            'curriculum_list_id' => $curriculum->id,
            'name' => $curriculum->name,
            'curriculum_type' => $curriculum_type,
            'curriculum_slug' => ($curriculum_type != 'section') ? $curriculum->slug : null,
            'course_slug' => $curriculum->courseDetail->slug ?? null,
            'time' => $curriculum->time ?? null,
            'is_active' => $curriculum->is_active ?? 0,
        ]);
    }

    public function update($curriculum_type, $curriculum)
    {
        $curriculumExist = Curriculum::where(['curriculum_list_id' => $curriculum->id, 'curriculum_type' => $curriculum_type])->first();
        if (isset($curriculumExist)) {
            $curriculumExist->update([
                'course_id' => $curriculum->course_id,
                'section_id' => ($curriculum_type == 'section') ? $curriculum->id : $curriculum->section_id,
                'curriculum_list_id' => $curriculum->id,
                'name' => $curriculum->name,
                'curriculum_type' => $curriculum_type,
                'curriculum_slug' => ($curriculum_type != 'section') ? $curriculum->slug : null,
                'course_slug' => $curriculum->courseDetail->slug ?? null,
                'time' => $curriculum->time ?? null,
                'is_active' => $curriculum->is_active ?? 0,
            ]);
        }
    }

    public function delete($curriculum_type, $curriculum_id)
    {
        Curriculum::where(['curriculum_list_id' => $curriculum_id, 'curriculum_type' => $curriculum_type])->delete();
    }

    public function updateCourseTime($course_id)
    {
        $course = Course::where('id', $course_id)->first();
        $courseSeconds = 0;
        foreach ($course->relatedCurriculumSections as $sectionCurriculum) {
            $sectionSeconds = 0;
            foreach ($sectionCurriculum->getSectionChildData as $lesson) {
                if (isset($lesson->time)) {
                    $courseSeconds += strtotime($lesson->time) - strtotime('TODAY');
                    $sectionSeconds += strtotime($lesson->time) - strtotime('TODAY');
                }
            }
            $sectionHours = floor($sectionSeconds / 3600);
            $sectionMinutes = floor(($sectionSeconds / 60) % 60);
            $sectionSeconds = $sectionSeconds % 60;
            $sectionTime = $sectionHours . ':' . $sectionMinutes . ':' . $sectionSeconds;
            $sectionCurriculum->update(['time' => $sectionTime]);
        }
        $courseHours = floor($courseSeconds / 3600);
        $courseMinutes = floor(($courseSeconds / 60) % 60);
        $courseSeconds = $courseSeconds % 60;
        $time = $courseHours . ':' . $courseMinutes . ':' . $courseSeconds;
        $course->update(['time' => $time]);
    }
}
