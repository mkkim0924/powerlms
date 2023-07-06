<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $images = ['default-article-1.jpg', 'default-article-2.jpg', 'default-article-3.jpg', 'default-article-4.jpg', 'default-article-5.jpg', 'default-article-6.jpg', 'default-article-7.jpg', 'default-article-8.jpg'];
        $title = $this->faker->text(50);
        $content = "";
        $content .= '<div class="single-post-txt"><p>'.$this->faker->paragraph(10).'</p></div>';
        $content .= '<div class="post-inner-img">
                                    <img class="img-fluid" src="'.url('frontend-assets/images/blog/post-'.rand(1, 4).'.jpg').'" alt="blog-post-image">
                                </div>';
        $content .= '<div class="single-post-txt">';
        $content .= '<p>'.$this->faker->paragraph(15).'</p>';
        $content .= '<h5 class="h5-lg">'.str_replace('.', '', $this->faker->sentence($nbWords = 5, $variableNbWords = true)).'</h5>';
        $content .= '<p>'.$this->faker->paragraph(10).'</p>';
        $content .= '<div class="quote">
                                        <p>"Lorem ipsum dolor sit amet, lectus laoreet impedit gestas. Aenean magna
                                            ligula eget
                                            dolor suscipit egestas viverra dolor iaculis luctus magna suscipit egestas "
                                        </p>
                                    </div>';
        $content .= '<p>'.$this->faker->paragraph(12).'</p>';
        $content .= '<div class="post-inner-img">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe width="950" height="450" src="https://www.youtube.com/embed/7e90gBu4pas" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                        </div>
                                    </div>';
        $content .= '<h5 class="h5-lg">'.str_replace('.', '', $this->faker->sentence($nbWords = 5, $variableNbWords = true)).'</h5>';
        $content .= '<p>'.$this->faker->paragraph(12).'</p>';
        $content .= '<ul class="txt-list mb-15"><li>'.$this->faker->paragraph(5).'</li>';
        $content .= '<li>'.$this->faker->paragraph(6).'</li></ul>';
        $content .= '<p>'.$this->faker->paragraph(5).'</p>';
        $content .= '</div>';
        return [
            'category_id' => rand(1, 10),
            'title' => $title,
            'slug' => str_slug($title),
            'content' => $content,
            'author_name' => $this->faker->name,
            'image' => array_random($images),
        ];
    }
}
