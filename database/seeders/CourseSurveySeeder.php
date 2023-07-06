<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSurvey;
use App\Models\CourseSurveyQuestion;
use App\Models\CourseSurveyQuestionOptions;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CourseSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseSurvey::truncate();
        CourseSurveyQuestion::truncate();
        CourseSurveyQuestionOptions::truncate();

        $factory = Factory::create();

        $courses = Course::byActive()->get();
        foreach ($courses as $course) {
            $survey_types = ['pre','post'];
            foreach ($survey_types as $survey_type) { 
                $view_type = ['list','tab'];
                $course_survey = CourseSurvey::Create([
                    'course_id' => $course->id,
                    'survey_type' => $survey_type,
                    'view_type' => $view_type[array_rand($view_type, 1)],
                    'name' => $course->name .  $survey_type  .' Survey',
                    'description' => $factory->paragraph(3),
                    'is_active' => 1,
                    'is_skippable' => 1,
                ]);   
                foreach (CourseSurveyQuestion::control_type as $key => $value) {
                    $course_survey_que = CourseSurveyQuestion::create([
                        'survey_id' => $course_survey->id,
                        'title' => $factory->paragraph(1),
                        'type' => $key,
                    ]);
                    if ($key == 'single_choice' || $key == 'multiple_choice') {
                        for ($i=1; $i < 5; $i++) { 
                            CourseSurveyQuestionOptions::create([
                                'survey_id' => $course_survey->id,
                                'survey_question_id' => $course_survey_que->id,
                                'option_id' => $i,
                                'content' => $factory->words(3,true),
                            ]);
                        }
                    }
                } 
            }
        }
        
    }
}
