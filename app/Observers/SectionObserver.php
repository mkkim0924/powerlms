<?php

namespace App\Observers;

use App\Models\Quiz;
use App\Models\Sections;
use App\Models\Units;
use App\Services\CurriculumService;

class SectionObserver
{
    public function created(Sections $section)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->store('section', $section);
    }

    public function updated(Sections $section)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->update('section', $section);
    }

    public function deleted(Sections $section)
    {
        Units::where('section_id', $section->id)->delete();
        Quiz::where('section_id', $section->id)->delete();
        $curriculumService = new CurriculumService();
        $curriculumService->delete('section', $section);
    }

    public function restored(Sections $section)
    {
    }

    public function forceDeleted(Sections $section)
    {
    }
}
