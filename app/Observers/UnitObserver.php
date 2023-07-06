<?php

namespace App\Observers;

use App\Models\UnitFaq;
use App\Models\Units;
use App\Services\CurriculumService;

class UnitObserver
{
    public function created(Units $unit)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->store('unit', $unit);
        $curriculumService->updateCourseTime($unit->course_id);
    }

    public function updated(Units $unit)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->update('unit', $unit);
        $curriculumService->updateCourseTime($unit->course_id);
    }

    public function deleted(Units $unit)
    {
        UnitFaq::where('unit_id', $unit->id)->delete();
        $curriculumService = new CurriculumService();
        $curriculumService->delete('unit', $unit->id);
    }

    public function restored(Units $unit)
    {
    }

    public function forceDeleted(Units $unit)
    {
    }
}
