<?php

namespace Database\Seeders;

use App\Models\Locale;
use App\Models\Translation;
use Barryvdh\TranslationManager\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AddMissingTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Manager $manager
     * @return void
     */
    public function run(Manager $manager)
    {
        $otherLocales = Locale::where('short_name', '!=', 'en')->pluck('short_name')->toArray();
        $groupKeys = [
            'backend' => [
                'course_interview_question.label.select_course' => 'Select Course',
                'course_interview_question.label.questions'=> 'Question',
                'course_interview_question.label.course_name' => 'Course Name',
                'course_interview_question.label.answer' => 'Answer',
                'course_interview_question.label.action'=> 'Action',
                'course_interview_question.header.list'=>'Course Interview Questions',
                'course_interview_question.header.edit' => 'Edit Course Interview Question',
                'course_interview_question.header.create' => 'Create Course Interview Question',
            ],
            'frontend' => [
                'courses_details.interview_questions_title' => 'Interview Questions',
            ]
        ];

        foreach($groupKeys as $group => $keys){
            foreach ($keys as $key => $value){
                $recordsExist = Translation::where(['group' => $group, 'key' => $key, 'locale' => 'en'])->exists();
                if (!$recordsExist){
                    Translation::create([
                        'status' => 0,
                        'locale' => 'en',
                        'group' => $group,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
                foreach ($otherLocales as $locale){
                    $otherLangRecordsExist = Translation::where(['group' => $group, 'key' => $key, 'locale' => $locale])->exists();
                    $translated_text = Str::apiTranslateWithAttributes($value, $locale, 'en');
                    if (!$otherLangRecordsExist){
                        Translation::create([
                            'status' => 0,
                            'locale' => $locale,
                            'group' => $group,
                            'key' => $key,
                            'value' => $translated_text,
                        ]);
                    }
                }
            }
            $manager->exportTranslations($group,false);
        }
    }
}
