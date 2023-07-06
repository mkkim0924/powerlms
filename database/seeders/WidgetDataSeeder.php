<?php

namespace Database\Seeders;

use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Widget::truncate();
        $widgets = [
            [
                'identifier' => 'promotional_section_one_widget',
                'title' => [
                    'en' => 'Transform your life through online education',
                    'es' => 'Transforma tu vida a través de la educación en línea',
                    'fr' => "Transformez votre vie grâce à l'éducation en ligne",
                    'ar' => 'غير حياتك من خلال التعليم عبر الإنترنت',
                ],
                'description' => [
                    'en' => '<p>An enim nullam tempor sapien gravida donec porta and blandit ipsum enim justo integer velna vitae auctor integer congue magna and purus pretium risus ligula rutrum luctus ultrice</p>
                        <ul class="txt-list mb-15">
                            <li>Nullam rutrum eget nunc varius etiam mollis risus undo</li>
                            <li>Integer congue magna at pretium purus pretium ligula at rutrum risus luctus dolor auctor ipsum blandit purus</li>
                            <li>Risus at congue etiam aliquam sapien egestas posuere</li>
                            <li>At pretium purus integer congue magna pretium ligula at ipsum blandit purus rutrum risus luctus dolor auctor</li>
                        </ul>'
                ],
                'image' => 'default-image-01.png',
            ],
            [
                'identifier' => 'promotional_section_two_widget',
                'title' => [
                    'en' => 'Learn new personal & professional skills online',
                    'es' => 'Transforma tu vida a través de la educación en línea',
                    'fr' => "Transformez votre vie grâce à l'éducation en ligne",
                    'ar' => "غير حياتك من خلال التعليم عبر الإنترنت",
                ],
                'description' => [
                    'en' => '<p>An enim nullam tempor sapien gravida donec porta and blandit ipsum enim justo integer velna vitae auctor integer congue magna and purus pretium risus ligula rutrum luctus ultrice</p>
                        <ul class="txt-list mb-15">
                            <li>Nullam rutrum eget nunc varius etiam mollis risus undo</li>
                            <li>Integer congue magna at pretium purus pretium ligula at rutrum risus luctus dolor auctor ipsum blandit purus</li>
                            <li>Risus at congue etiam aliquam sapien egestas posuere</li>
                        </ul>'
                ],
                'image' => 'default-image-02.png',
            ],
            [
                'identifier' => 'our_goal_or_vision_section_widget',
                'title' => [
                    'en' => 'Our goal is to make online education work for everyone',
                    'es' => 'Nuestro objetivo es hacer que la educación en línea funcione para todos.',
                    'fr' => "Notre objectif est de rendre l'éducation en ligne accessible à tous",
                    'ar' => 'هدفنا هو جعل التعليم عبر الإنترنت مفيدًا للجميع',
                ],
                'description' => [
                    'en' => '<p>Sagittis congue augue egestas volutpat egestas magna suscipit egestas magna ipsum vitae purus efficitur ipsum primis and cubilia laoreet augue egestas luctus donec diam. Curabitur ac dapibus
                            libero mauris donec ociis and neque. Phasellus blandit tristique justo ut aliquam. Aliquam vitae molestie nunc sapien justo, aliquet non molestie augue tempor sapien</p>'
                ],
                'image' => 'default-image-03.jpg',
            ],
            [
                'identifier' => 'video_promotion_section_widget',
                'title' => [
                    'en' => 'Take the first step to knowledge with PowerLMS',
                    'es' => 'Da el primer paso hacia el conocimiento con PowerLMS',
                    'fr' => "Faites le premier pas vers la connaissance avec PowerLMS",
                    'ar' => "اتخذ الخطوة الأولى نحو المعرفة باستخدام PowerLMS",
                ],
                'description' => [
                    'en' => '<p>Cursus porta, feugiat primis in ultrice ligula risus auctor tempus dolor feugiat, felis lacinia risus</p>'
                ],
                'image' => 'default-video-image.jpg',
                'video_url' => 'https://www.youtube.com/watch?v=0gv7OC9L2s8',
            ],
            [
                'identifier' => 'promotional_section_three_widget',
                'title' => null,
                'description' => [
                    'en' => '<h4>Learn something new every day with <span>PowerLMS</span></h4>',
                    'es' => '<h4>Aprende algo nuevo todos los días con <span>PowerLMS</span></h4>',
                    'fr' => '<h4>Apprenez quelque chose de nouveau chaque jour avec <span>PowerLMS</span></h4>',
                    'ar' => '<h4>تعلم شيئًا جديدًا كل يوم مع <span>PowerLMS</span></h4>',
                ],
                'image' => 'default-image-04.jpg',
            ],
        ];
        foreach ($widgets as $widget){
            Widget::create($widget);
        }
    }
}
