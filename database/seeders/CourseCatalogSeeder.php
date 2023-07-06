<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Course;
use App\Models\Faqs;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Models\Review;
use App\Models\Sections;
use App\Models\UnitFaq;
use App\Models\Units;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('courses')->truncate();
        DB::table('bundles')->truncate();
        DB::table('bundle_courses')->truncate();
        DB::table('faqs')->truncate();
        DB::table('reviews')->truncate();
        DB::table('sections')->truncate();
        DB::table('units')->truncate();
        DB::table('curriculum')->truncate();
        DB::table('quiz')->truncate();
        DB::table('quiz_questions')->truncate();
        DB::table('quiz_question_options')->truncate();
        DB::table('unit_faqs')->truncate();

        $bundles = [
            [
                'instructor_id' => 1,
                'category_id' => 1,
                'name' => 'Complete Digital Marketing Course',
                'slug' => 'complete-digital-marketing-course',
                'price' => '5999',
                'total_enrollments' => 0,
                'image' => 'default-bundle-1-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Digital Marketing Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 1,
                'name' => 'Complete SEO Training Course',
                'slug' => 'complete-seo-Training-course',
                'price' => '4999',
                'total_enrollments' => 0,
                'image' => 'default-bundle-3-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete SEO Training Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 1,
                'name' => 'Complete Social Media Marketing Course',
                'slug' => 'complete-social-media-marketing-course',
                'price' => '2999',
                'total_enrollments' => 0,
                'image' => 'default-bundle-4-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Social Media Marketing Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 1,
                'name' => 'Complete Ultimate Google Analytics (GA4) Course',
                'slug' => 'complete-ultimate-google-analytics-course',
                'price' => '4999',
                'total_enrollments' => 0,
                'image' => 'default-bundle-5-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Ultimate Google Analytics (GA4) Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 2,
                'category_id' => 2,
                'name' => 'Complete Web And Graphic Design Course',
                'slug' => 'complete-web-and-graphic-design-course',
                'price' => '5599',
                'total_enrollments' => 0,
                'image' => 'default-bundle-4-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Web And Graphic Design Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 2,
                'category_id' => 2,
                'name' => 'Complete Graphic Design Masterclass Course',
                'slug' => 'complete-graphic-design-masterclass-course',
                'price' => '2499',
                'total_enrollments' => 0,
                'image' => 'default-bundle-8-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Graphic Design Masterclass Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 2,
                'category_id' => 2,
                'name' => 'Complete Graphic Design Bootcamp Course',
                'slug' => 'complete-graphic-design-bootcamp-course',
                'price' => '5099',
                'total_enrollments' => 0,
                'image' => 'default-bundle-9-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Graphic Design Bootcamp Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 2,
                'category_id' => 2,
                'name' => 'Complete Graphic Design Theory for Beginners Course',
                'slug' => 'complete-Graphic-design-theory-for-beginners-course',
                'price' => '2099',
                'total_enrollments' => 0,
                'image' => 'default-bundle-10-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Graphic Design Theory for Beginners Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 3,
                'category_id' => 3,
                'name' => 'Complete Computer Networking Course',
                'slug' => 'complete-computer-networking-course',
                'price' => '6499',
                'total_enrollments' => 0,
                'image' => 'default-bundle-5-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Computer Networking Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 3,
                'category_id' => 3,
                'name' => 'Complete The Complete Networking Fundamentals Course',
                'slug' => 'complete-the-complete-networking-fundamentals-course',
                'price' => '6999',
                'total_enrollments' => 0,
                'image' => 'default-bundle-6-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete The Complete Networking Fundamentals Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 3,
                'category_id' => 3,
                'name' => 'Complete Cisco CCNA - Complete Course',
                'slug' => 'complete-cisco-ccna-complete-course',
                'price' => '6099',
                'total_enrollments' => 0,
                'image' => 'default-bundle-11-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Cisco CCNA - Complete Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 3,
                'category_id' => 3,
                'name' => 'Complete Linux for Network Engineers Course',
                'slug' => 'complete-linux-for-network-engineers-course',
                'price' => '6099',
                'total_enrollments' => 0,
                'image' => 'default-bundle-4-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Linux for Network Engineers Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 4,
                'category_id' => 4,
                'name' => 'Complete Master Laravel Programing Course',
                'slug' => 'complete-master-laravel-programing-course',
                'price' => '8500.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-7-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Master Laravel Programing Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 4,
                'category_id' => 4,
                'name' => 'Complete Python Programming Masterclass Course',
                'slug' => 'complete-python-programming-masterclass-course',
                'price' => '2999.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-9-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Python Programming Masterclass Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 4,
                'category_id' => 4,
                'name' => 'Complete C++: From Beginner to Expert Course',
                'slug' => 'complete-from-beginner-to-expert-course',
                'price' => '8599.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-2-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete C++: From Beginner to Expert Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 4,
                'category_id' => 4,
                'name' => 'Complete Web Development Course',
                'slug' => 'complete-web-development-course',
                'price' => '2099.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-1-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Web Development Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 5,
                'name' => 'Complete Wordpress Development Course',
                'slug' => 'complete-wordpress-development-course',
                'price' => '4999.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-10-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Wordpress Development Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 5,
                'name' => 'Complete Software Development Fundamentals Course',
                'slug' => 'complete-software-development-fundamentals-course',
                'price' => '4500.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-11-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Software Development Fundamentals Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 5,
                'name' => 'Complete Website Development Course',
                'slug' => 'complete-website-development-course',
                'price' => '4099.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-9-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Website Development Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],
            [
                'instructor_id' => 1,
                'category_id' => 5,
                'name' => 'Complete Learn C# with Windows Forms Course',
                'slug' => 'complete-learn-with-windows-forms-course',
                'price' => '4599.00',
                'total_enrollments' => 0,
                'image' => 'default-bundle-4-img.jpg',
                'is_active' => 1,
                'description' => $faker->paragraph(15),
                'meta_title' => 'Complete Learn C# with Windows Forms Course',
                'meta_description' => $faker->paragraph(2),
                'meta_keywords' => $faker->paragraph(2),
            ],

        ];
        DB::table('bundles')->insert($bundles);

        $bundleCourses = [
            ['bundle_id' => 1, 'course_id' => 1],           //category 1
            ['bundle_id' => 1, 'course_id' => 3],
            ['bundle_id' => 1, 'course_id' => 4],
            ['bundle_id' => 2, 'course_id' => 3],
            ['bundle_id' => 2, 'course_id' => 4],
            ['bundle_id' => 2, 'course_id' => 9],
            ['bundle_id' => 3, 'course_id' => 1],
            ['bundle_id' => 3, 'course_id' => 4],
            ['bundle_id' => 3, 'course_id' => 9],
            ['bundle_id' => 4, 'course_id' => 1],
            ['bundle_id' => 4, 'course_id' => 3],
            ['bundle_id' => 4, 'course_id' => 9],

            ['bundle_id' => 5, 'course_id' => 5],           //category 2
            ['bundle_id' => 5, 'course_id' => 10],
            ['bundle_id' => 5, 'course_id' => 11],
            ['bundle_id' => 6, 'course_id' => 10],
            ['bundle_id' => 6, 'course_id' => 11],
            ['bundle_id' => 6, 'course_id' => 12],
            ['bundle_id' => 7, 'course_id' => 5],
            ['bundle_id' => 7, 'course_id' => 11],
            ['bundle_id' => 7, 'course_id' => 12],
            ['bundle_id' => 8, 'course_id' => 5],
            ['bundle_id' => 8, 'course_id' => 10],
            ['bundle_id' => 8, 'course_id' => 12],

            ['bundle_id' => 9, 'course_id' => 8],            //category 3
            ['bundle_id' => 9, 'course_id' => 13],
            ['bundle_id' => 9, 'course_id' => 14],
            ['bundle_id' => 10, 'course_id' => 13],
            ['bundle_id' => 10, 'course_id' => 14],
            ['bundle_id' => 10, 'course_id' => 15],
            ['bundle_id' => 11, 'course_id' => 8],
            ['bundle_id' => 11, 'course_id' => 14],
            ['bundle_id' => 11, 'course_id' => 15],
            ['bundle_id' => 12, 'course_id' => 8],
            ['bundle_id' => 12, 'course_id' => 13],
            ['bundle_id' => 12, 'course_id' => 15],

            ['bundle_id' => 13, 'course_id' => 7],          //category 4
            ['bundle_id' => 13, 'course_id' => 16],
            ['bundle_id' => 13, 'course_id' => 17],
            ['bundle_id' => 14, 'course_id' => 16],
            ['bundle_id' => 14, 'course_id' => 17],
            ['bundle_id' => 14, 'course_id' => 18],
            ['bundle_id' => 15, 'course_id' => 7],
            ['bundle_id' => 15, 'course_id' => 16],
            ['bundle_id' => 15, 'course_id' => 17],
            ['bundle_id' => 16, 'course_id' => 16],
            ['bundle_id' => 16, 'course_id' => 17],
            ['bundle_id' => 16, 'course_id' => 18],

            ['bundle_id' => 17, 'course_id' => 2],          //category 5
            ['bundle_id' => 17, 'course_id' => 6],
            ['bundle_id' => 17, 'course_id' => 19],
            ['bundle_id' => 18, 'course_id' => 6],
            ['bundle_id' => 18, 'course_id' => 19],
            ['bundle_id' => 18, 'course_id' => 20],
            ['bundle_id' => 19, 'course_id' => 2],
            ['bundle_id' => 19, 'course_id' => 6],
            ['bundle_id' => 19, 'course_id' => 19],
            ['bundle_id' => 20, 'course_id' => 6],
            ['bundle_id' => 20, 'course_id' => 19],
            ['bundle_id' => 20, 'course_id' => 20],
        ];
        DB::table('bundle_courses')->insert($bundleCourses);

        $courses = [
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'name' => "Digital Marketing Course 2023",
                'slug' => "digital-marketing-course-2023",
                'tiny_description' => "Learn Digital Marketing, Copywriting, Ads, SEO, Video Creation. Become a Digital Marketing Nomad. Freelance and Travel.",
                'content' => "<p>Digital marketing education. ontact with high-value clients Follow your dreams. Take use of the animated videos, useful screen recordings, extensive resource centre, 20+ writing assignments, and 210+ interactive quizzes that make learning enjoyable.</p><p>Today's internet business is more competitive than ever, therefore if you want to succeed online, you need to have great digital marketing skills. The principles of SEO, digital marketing, and social media will be covered in this digital marketing course. In order for you to comprehend the most crucial information you need to know, we will be breaking each of these issues down.<br></p><p>If you own a business or want to sell anything online, digital marketing is essential. If you want people to know you exist, even if you're just trying to develop your profile, you need to have a strong online presence. Digital marketing is to increase awareness, engage with customers who are interested in what you have to offer, and influence them to do the desired actions. To contact potential clients, it makes use of digital communication channels like the web, mobile devices, social media platforms, and search engines.</p><p>Digital marketing is similar to traditional marketing in that it involves locating potential customers and communicating with them at the appropriate time, place, and tone.</p><p>One significant advantage of digital marketing over traditional marketing is the ability to use analytics tools to track your campaigns in real-time and quickly change your strategy. Making these kinds of changes would typically be more expensive and time-consuming, but thanks to digital marketing, it's simpler to course correct than it would be if you had spent money on a print advertisement.<br></p>",
                'requirements' => "<p>A smartphone or laptop with internet access This course is designed with total beginners in mind.<br></p>",
                'what_you_will_learn_points' => ["Learn about video production, SEO, and digital marketing. Become a nomad in digital marketing. contact with high-value clients Around-the-World Travel. Follow your dreams.", "Become an expert in digital marketing. Work as a Freelance Consultant for Digital Marketing. Marketplace Brands Promote your own company or get a well-paying job.", "Find out how to create your own successful Facebook business page and a professional-looking WordPress website without any coding knowledge! . Create HD videos", "Learn copywriting and everything you need to know to start from scratch when creating highly persuasive content. Discover dozens of copywriting techniques, such as AIDA.", "Find out how to make and edit videos with the potential to go viral. Learn about video marketing, video production, and video SEO. In Adobe Premier Pro, cut videos.", "Learn every aspect of digital marketing that you require in order to conduct profitable online marketing. Study Client Outreach Techniques. How to Sell Your Digital Skills: Learn This."],
                'who_this_course_is_for_points' => ["My dearest student, for you.", "For beginners seeking to get highly sought-after skills in digital marketing."],
                'image' => "default-course-1-img.jpg",
                'is_free' => 1,
                'price' => 0,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Advanced",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=SGHjY_tfo7U",
                'course_status' => 1,
                'expiration_days' => 50,
                'meta_title' => 'Digital Marketing Course 2023',
                'meta_description' => 'Digital Marketing Course 2023',
                'meta_keywords' => 'Digital Marketing Course 2023',
            ],
            [
                'category_id' => 5,
                'instructor_id' => 1,
                'name' => "Wordpress Development Course",
                'slug' => "wordpress-development",
                'tiny_description' => "The Ultimate Web Developer Bootcamp is here to serve you. You can study front-end AND back-end development all in one place here.
In a short of weeks, we'll transform you from a complete beginner to a capable full-stack web developer.",
                'content' => "<p>By learning how to create entirely unique WordPress powered sites, you can unleash WordPress' full potential and move beyond being \"simply a blog platform.\"<br><br>Revisions for 2019: A new three-part tutorial on creating our own unique block type for WordPress's new \"Gutenberg\" Block Editor.<br><br>I've studied WordPress, PHP, and JavaScript for the past 12 years, and I'm ready to share what I've learned with you. Join me on this adventure to learn WordPress development.</p><p>Together, we will create a website for a hypothetical university, learning the following things as we go:</p><ul><li>Install WordPress on your personal computer to get a private test version of the platform to work with.</li><li>Learn about the PHP programming language (this is what powers WordPress)</li><li>Establish a New Theme You'll discover how to transform any HTML template into a functional WordPress theme.</li><li>Make your own custom fields and post types.</li><li>Link many bits of content together (e.g. a professor and a program)</li><li>Learn the fundamentals of JavaScript (object-oriented)</li><li>Make use of the WP REST API.</li><li>Learn JavaScript so you can instantly interface with the WordPress backend.</li><li>Allow users to register for a free account on our website.</li><li>Create a \"My Notes\" function (user specific single page application with real-time CRUD actions)</li><li>Allow users to \"like\" or \"heart\" professors, which will instantly change the professor's like count.</li><li>Launch our website live on the internet for everyone to see.</li><li>plus a lot more!<br></li></ul>",
                'requirements' => "<ul><li>You should have a PC or Mac and know how to turn it on!</li><li>Have an Internet connection<br></li></ul>",
                'what_you_will_learn_points' => ["HTML5", "CSS3", "Javascript", "Bootstrap 4", "DOM Manipulation", "NPM", "Node", "MongoDB", "REST", "Express", "ES6", "React"],
                'who_this_course_is_for_points' => ["This course is for beginners - no prior experience is required", "This course is for entrepreneurs & hobbyists", "This course is for those looking for a career change", "This course is for anyone who wants to learn front-end and backend development", "This course is for students"],
                'image' => "default-course-2-img.jpg",
                'is_free' => 0,
                'price' => 1500.00,
                'discount_flag' => 1,
                'discounted_price' => 449.00,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=DqbA3IAciZ0",
                'course_status' => 1,
                'expiration_days' => 60,
                'meta_title' => 'Wordpress Development Course',
                'meta_description' => 'Wordpress Development Course',
                'meta_keywords' => 'Wordpress Development Course',
            ],
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'name' => "SEO 2023: Complete SEO Training",
                'slug' => "seo-2023-complete-seo-training",
                'tiny_description' => "Learn the SEO techniques you need to raise the rating of your website and increase visitors.",
                'content' => "<p>If you're like most business owners, you recognise the value of SEO but may lack the time or funds to implement it yourself. You may have attempted to learn through articles and tutorials on the internet but found them annoying and perplexing. Or perhaps you hired someone to assist with your SEO but were unsatisfied with the outcomes.</p><p>We created our comprehensive SEO training programme with busy business owners in mind. You'll have all the skills and information required to start getting results by the end of this course.</p><p>\"Search Engine Optimization\" is referred to as SEO. In order to increase a website's exposure and organic search results in Google and other major search engines, this long-term marketing technique is used. It's a technique used by webmasters to boost the exposure of their website and natural search engine traffic.</p><p>To rank well for relevant keywords and phrases that potential clients would type into search engines when looking for a company like yours is the ultimate goal of SEO.</p><p>In order to maintain their websites' and companies' high rankings, SEO experts and business owners must constantly adjust their strategies in response to Google's regular algorithm updates. A website's ranking is determined by a variety of variables, however some are more crucial than others.</p><p>When it comes to optimising a website for the search engines, different SEO specialists have varying views on what works and what doesn't. Some people might find success with one strategy and failure with another. Because of this, this course teaches you more than simply what I am aware of and have encountered. The foundation of this entire course is a study of SERPs (Search engine result pages) constructed from 10,000 keywords for the top 30 search results on the first three search pages.</p><p>When launching a new business, it's crucial to conduct research to identify your rivals and the keyphrases you should be focusing on.</p>",
                'requirements' => "<ol><li>To develop content and optimise it for SEO, you need a website, preferably one powered by WordPress (Search Engine Optimization)</li><li>You might have to create free trial accounts for expensive internet SEO tools.</li><li>You will gain a better understanding of what to do to draw clients to your company as a result. You need take a close look at the following to conduct an accurate competitor analysis:</li></ol>",
                'what_you_will_learn_points' => ["Learn everything there is to know about search engines and SEO.", "Research your keywords to find out what your potential consumers are looking for.", "Competitor analysis: Be aware of where your rivals stand", "Learn about technical SEO and what your site should contain.", "Learn the essentials of a healthy website with our guide on core web vitals.", "Learn how to make your pages load quickly using PageSpeed SEO."],
                'who_this_course_is_for_points' => ["For people who are interested in pursuing a career in SEO or who are already in the industry", "For companies that have websites", "For individuals who work for an SEO company or who own an SEO company", "For people who are employed as or who would like to be employed as SEO Analysts, SEO Specialists, SEO Managers, or SEO Consultants.", "For people who are engaged in digital marketing and have a focus on SEO"],
                'image' => "default-course-3-img.jpg",
                'is_free' => 0,
                'price' => 6249.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=P8hhLu5uE5A",
                'course_status' => 1,
                'expiration_days' => 50,
                'meta_title' => 'SEO 2023: Complete SEO Training',
                'meta_description' => 'SEO 2023: Complete SEO Training',
                'meta_keywords' => 'SEO 2023: Complete SEO Training',
            ],
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'name' => "Social Media Marketing Course",
                'slug' => "social-media-marketing-course",
                'tiny_description' => "Online Digital Marketing / Social Media Strategy For Beginners - Posts / Blogs / Podcasts / Video / Google Local SEO",
                'content' => "<p><b>Social media marketing: A Science</b></p><ol><li>Do you wish to learn the art and science of using social media marketing to generate free traffic for your website?</li><li>When you want to learn how to use Facebook, Twitter, LinkedIn, Instagram, and Pinterest to drive traffic to your website and generate sales, do you feel frustrated by all the conflicting advice on the internet and how everyone says that you need to squander money on Social Media Advertising?</li><li>Do you want to discover the best strategies and tested techniques for social media marketing?</li><li>Do you want to learn how to create several sorts of marketing content, such as blog entries, social media posts, audio and video material?</li></ol><p>You will learn how to master social media marketing, blogging, copywriting, email marketing, local search engine optimization, SEO, YouTube marketing, video production, vlogging, and Instagram photography in this course. We will also demonstrate how to take a profile picture for your social media profile using just an iPhone or Smartphone!</p><p>All the tools you need to establish a strong internet marketing presence...</p><p>You will discover what strategies for online digital marketing are effective and ineffective as well as where to focus your time and energy.</p><p>You will comprehend the psychology of the buying process and how to apply it to your content development, social media marketing, and sales process.</p><p>Additionally, you will learn how to use social media marketing to generate visitors to your website and how to develop engaging content for it.</p>",
                'requirements' => "<ol><li>To develop content and optimise it for SEO, you need a website, preferably one powered by WordPress (Search Engine Optimization)</li><li>You might have to create free trial accounts for expensive internet SEO tools.</li></ol>",
                'what_you_will_learn_points' => ["You will comprehend how to set up an easy-to-use yet effective online marketing strategy for your business.", "Know how social media marketing actually benefits your company.", "Create a social media schedule and plan so that you may carry out your marketing to its intended goal.", "Recognize the Social Media Platforms and Their Use", "Write articles and blogs that encourage readers to take action", "Show That You Are Aware of How Email Marketing Operates", "Become An Expert In Search Engine Optimization", "Create a YouTube marketing channel and get knowledge of video production and editing for marketing."],
                'who_this_course_is_for_points' => ["This course is made to assist people who want to become experts in social media marketing, SEO, and online advertising.", "For Those Who Want To Understand The Psychology Of Social Media Marketing And Content Marketing, This Course Is For You.", "This Course Is Beneficial For Marketers, Entrepreneurs, and Traditional Marketers.", "This Course Is Appropriate For Complete Beginners Who Want To Advance To An Advanced Knowledge Of The Subject This Course Is NOT A Basic Course On Setting Up Facebook Pages Etc.", "This Course Is Appropriate For Those Who Want To Start A Social Media Marketing Consultation Business", "This course is NOT a paid advertising course in any kind."],
                'image' => "default-course-4-img.jpg",
                'is_free' => 0,
                'price' => 3499.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Advanced",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=P8hhLu5uE5A",
                'course_status' => 1,
                'expiration_days' => 80,
                'meta_title' => 'Social Media Marketing Course',
                'meta_description' => 'Social Media Marketing Course',
                'meta_keywords' => 'Social Media Marketing Course',
            ],
            [
                'category_id' => 2,
                'instructor_id' => 2,
                'name' => "Adobe After Effects CC Course",
                'slug' => "adobe-after-effects-cc-course",
                'tiny_description' => "Learn the techniques to start your career as a Motion Graphic artist.",
                'content' => "<p>You'll discover how to use Adobe After Effects to create motion graphics in this course. Everything you need to start creating stunning animation and infographics is covered in this motion graphics course.</p><p>You will receive downloadable exercise files with this course so you can follow the trainer's instructions to the letter. Additionally, each video includes finished files that you may download and compare to the trainers'.</p><p>Your instructor is a certified instructor and certified expert in Adobe After Effects. For more than 12 years, Daniel has been producing immersive infographics and motion graphics.</p><p>It takes about three hours to complete the course. To make things easier to understand, each step has been divided into independent films.</p><p>Over 15 minor projects will be created during this session to help you practise using the software. The exercises we produce can potentially be used in your personal portfolio.</p><p>On your PC, you must have Adobe After Effects installed. Direct downloads from Adobe include a 30-day free trial.</p><p>If the field of motion graphics has aroused you but you haven't started. You will excel in this introductory course.</p>",
                'requirements' => "<p>After Effects must be downloaded by the students. Although the more recent CC 2015 version is advised, the older CS6 version will still function.<br></p>",
                'what_you_will_learn_points' => ["Make stunning motion graphics", "Create enticing animated infographics", "Select the appropriate video settings.", "You'll quickly learn how to export your video.", "You'll have the ability to make smooth animations.", "Rendering your video for Vimeo and YouTube.", "Create interview titles.", "Make your motion graphics musical.", "Video trimming and editing", "You should watermark your video.", "Repairing wobbly video.", "Colorize and repair any problematic video."],
                'who_this_course_is_for_points' => ["People who wish to start making money as motion graphics designers should take this course.", "Beginners who want to learn how to use After Effects for infographics and motion graphics should take this course.", "No prior After Effects or animation experience is required.", "This course is designed for total novices.", "From nothing to hero", "People who already have a solid understanding of After Effects should NOT take this course. This is only for newcomers."],
                'image' => "default-course-5-img.jpg",
                'is_free' => 0,
                'price' => 4999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Advanced",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => 60,
                'meta_title' => 'Adobe After Effects CC Course',
                'meta_description' => 'Adobe After Effects CC Course',
                'meta_keywords' => 'Adobe After Effects CC Course',
            ],
            [
                'category_id' => 5,
                'instructor_id' => 1,
                'name' => "Website Development Course",
                'slug' => "website-development",
                'tiny_description' => "If you're interested in becoming a web developer, this course is a wonderful place to start. You will gain a general understanding of the fundamental and supporting technologies that underpin the internet as well as knowledge of the day-to-day duties of a web developer. You'll discover how front-end developers produce functional and simple-to-maintain websites and applications.",
                'content' => "<p>Welcome to the first course in the Meta Front-End Developer curriculum, Introduction to Front-End Development.<br><br>If you're interested in becoming a web developer, this course is a wonderful place to start. You will gain a general understanding of the fundamental and supporting technologies that underpin the internet as well as knowledge of the day-to-day duties of a web developer. You'll discover how front-end developers produce functional and simple-to-maintain websites and applications.<br><br>You'll learn about and have the chance to practice utilizing the fundamental web development technologies including HTML and CSS. Additionally, you will learn about contemporary UI frameworks like Bootstrap and React that make it simple to design interactive user interfaces.</p><p>You will be able to:</p><ul><li>Describe the role of a front-end developer by the end of the course.</li><ul><li>Describe the fundamental technologies that underlie the internet - Create a simple webpage using HTML - Use CSS to modify the design of a simple webpage</li><li>Describe the functions and features of the most popular UI frameworks. Describe what React is.</li><li>You will use HTML and the Bootstrap CSS framework to design and edit a webpage for the course's final project. You can create a responsive webpage with text and images that looks fantastic on any size screen by using a responsive style grid.</li></ul></ul><p><br></p><p>You will use HTML and the Bootstrap CSS framework to design and edit a webpage for the course's final project. You can create a responsive webpage with text and images that looks fantastic on any size screen by using a responsive style grid.<br><br>This introductory course is designed for students who are eager to discover the fundamentals of web programming. You don't need any prior web development expertise to succeed in this course; all you need are some basic internet navigational abilities and a desire to learn how to code.<br></p>",
                'requirements' => "<ul><li>There is no need for prior development experience.</li><li>Access to a range of open-source (free) applications.</li></ul>",
                'what_you_will_learn_points' => ["Differentiate between full-stack, front-end, and back-end developers.", "With HTML and CSS, construct and style a website.", "The advantages of using UI frameworks."],
                'who_this_course_is_for_points' => ["Anyone who would like to learn front-end web development"],
                'image' => "default-course-6-img.jpg",
                'is_free' => 0,
                'price' => 1499.00,
                'discount_flag' => 1,
                'discounted_price' => 999.00,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=HD6Vb0-BqBI",
                'course_status' => 1,
                'expiration_days' => 100,
                'meta_title' => 'Website Development Course',
                'meta_description' => 'Website Development Course',
                'meta_keywords' => 'Website Development Course',
            ],
            [
                'category_id' => 4,
                'instructor_id' => 4,
                'name' => "Master Laravel Programing Course",
                'slug' => "master-laravel-programing-course",
                'tiny_description' => "Gain expertise with the Laravel Framework from scratch! introductory and intermediate level course!",
                'content' => "<p>With this brand-new course, learners may learn Laravel from A to Z!</p><p>Nowadays, Laravel is the framework of choice for PHP developers. It has the best ecosystem of tools, is the simplest to learn how to use, and makes getting the task done quite enjoyable.</p><p>Laravel has the power to alter the way you perceive PHP in general. It is an entirely different language than it was before PHP 8, which is coming up.</p><p>In the domain of PHP, Laravel is similar to Ruby on Rails. better still. It is expressive, enjoyable, fluid, simple to learn, and simple to use. Both novices and experts alike adore it! You have the opportunity to join this joyful community of individuals who enjoy building things and be compensated for doing so.<br><br>In addition to my other courses, this course is the only one you'll ever need to learn everything there is to know about Laravel. How to set it up, get going, and then utilise all the potent features that contemporary web development has to offer!</p><p><br></p>",
                'requirements' => "<p>Basic PHP and Object Oriented Programming understanding<br></p>",
                'what_you_will_learn_points' => ["Eloquent is an ORM for working with databases.", "Queues, polymorphic relationships, and service containers are examples of advanced features.", "As you advance, learn all the theory while creating a functional application!", "PHP and Apache configuration for Windows and Mac", "How to efficiently use Visual Studio Code", "Serializing data, building APIs, using API resources, and API testing", "Controllers and Routes", "The command-line playground for Laravel Blade templates is called Laravel Tinker.", "Blade components", "Form creation and CSRF tokens", "Relationships are one to one, one to many, and many to many."],
                'who_this_course_is_for_points' => ["Any Novice PHP developer without previous framework exposure"],
                'image' => "default-course-7-img.jpg",
                'is_free' => 0,
                'price' => 5999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => 50,
                'meta_title' => 'Master Laravel Programing Course',
                'meta_description' => 'Master Laravel Programing Course',
                'meta_keywords' => 'Master Laravel Programing Course',
            ],
            [
                'category_id' => 3,
                'instructor_id' => 3,
                'name' => "Computer Networking Course",
                'slug' => "computer-networking-course",
                'tiny_description' => "Learn Computer Networks & OSI Layers to Computer/Electrical Engineering Students",
                'content' => "<p>The use of computer networks is on the rise. The majority of the sites you visit on a regular basis, including your house, school, and workplace, have them. You will discover the fundamentals of computer networks in this course.</p><p>When you start recognising networks all around you, you'll also begin to comprehend a significant portion of the IT industry. You'll discover many things, including how the Internet operates, how your Internet Service Provider (ISP) enables you to connect online, how data is shared without a connection to the Internet, and much more. Understanding computer networks is the first step in anything.</p><p>Setting up a network is a skill that is highly valuable nowadays, whether you are taking this course to better yourself, to earn a better mark at school, or for job. However, a lot of people lack the necessary skills. It will be possible for you to learn it in a short while.</p><p>Nobody wants their passwords, photos, papers, credit card information, or online activity to be shared without their consent. But as more people use computer networks, the concept of privacy is fading into obscurity. This training assists you in safeguarding your network at home or at the business as well as your online privacy.</p><p>You only need an internet connection and a computer or smartphone to take this course. Additionally, if you need assistance or don't understand something. I'm always available if you need me. I often reply within a day. You will receive a certificate of completion once this course is complete. that you might include in your profile or on your CV.<br></p>",
                'requirements' => "<p>Genuine interest in learning about computer networks</p><p>Simple computer system knowledge</p><p>No prior knowledge of coding or programming is necessary.</p><p>Commitment and discipline to reach your objectives more quickly</p>",
                'what_you_will_learn_points' => ["Computer Networks' Seven OSI Layers: Detailed Functionalities", "The networking equipment, such as hubs, switches, and routers.", "Switching and routing concepts at their most basic", "In the OSI\/TCP-IP model, the application layer position", "The role of the presentation layer in the OSI\/TCP-IP model", "With the OSI\/TCP-IP model, the session layer's role", "Position at the OSI\/TCP-IP transport layer", "The OSI\/TCP-IP model's network layer position", "OSI\/TCP-IP model work for the MAC\/DLL layer", "Position at the physical layer of the OSI\/TCP-IP model"],
                'who_this_course_is_for_points' => ["Computer Engineering Students", "Electrical Engineering Students", "Telecommunication Engineering Students"],
                'image' => "default-course-8-img.jpg",
                'is_free' => 0,
                'price' => 5999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => 50,
                'meta_title' => 'Computer Networking Course',
                'meta_description' => 'Computer Networking Course',
                'meta_keywords' => 'Computer Networking Course',
            ],
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'name' => "Ultimate Google Analytics (GA4) Course",
                'slug' => "ultimate-google-analytics",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-9-img.jpg",
                'is_free' => 0,
                'price' => 2999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Ultimate Google Analytics (GA4) Course',
                'meta_description' => 'Ultimate Google Analytics (GA4) Course',
                'meta_keywords' => 'Ultimate Google Analytics (GA4) Course',
            ],
            [
                'category_id' => 2,
                'instructor_id' => 2,
                'name' => "Graphic Design Masterclass",
                'slug' => "graphic-design-masterclass",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-10-img.jpg",
                'is_free' => 0,
                'price' => 5999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Graphic Design Masterclass',
                'meta_description' => 'Graphic Design Masterclass',
                'meta_keywords' => 'Graphic Design Masterclass',
            ],
            [
                'category_id' => 2,
                'instructor_id' => 2,
                'name' => "Graphic Design Bootcamp: Photoshop, Illustrator, InDesign",
                'slug' => "graphic-design-bootcamp-photoshop-illustrator-indesign",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-11-img.jpg",
                'is_free' => 0,
                'price' => 7999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'meta_description' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'meta_keywords' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
            ],
            [
                'category_id' => 2,
                'instructor_id' => 2,
                'name' => "Graphic Design Theory for Beginners Course",
                'slug' => "graphic-design-theory-for-beginners-course",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-12-img.jpg",
                'is_free' => 0,
                'price' => 5499.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Graphic Design Theory for Beginners Course',
                'meta_description' => 'Graphic Design Theory for Beginners Course',
                'meta_keywords' => 'Graphic Design Theory for Beginners Course',
            ],
            [
                'category_id' => 3,
                'instructor_id' => 3,
                'name' => "The Complete Networking Fundamentals Course",
                'slug' => "the-complete-networking-fundamentals-course",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-13-img.jpg",
                'is_free' => 0,
                'price' => 5499.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'The Complete Networking Fundamentals Course',
                'meta_description' => 'The Complete Networking Fundamentals Course',
                'meta_keywords' => 'The Complete Networking Fundamentals Course',
            ],
            [
                'category_id' => 3,
                'instructor_id' => 3,
                'name' => "Cisco CCNA - Complete Course with practical labs",
                'slug' => "cisco-ccna-complete-course-with-practical-labs",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-14-img.jpg",
                'is_free' => 0,
                'price' => 5499.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Cisco CCNA - Complete Course with practical labs',
                'meta_description' => 'Cisco CCNA - Complete Course with practical labs',
                'meta_keywords' => 'Cisco CCNA - Complete Course with practical labs',
            ],
            [
                'category_id' => 3,
                'instructor_id' => 3,
                'name' => "Linux for Network Engineers: Practical Linux with GNS3",
                'slug' => "linux-for-network-engineers-practical-linux-with-gns3",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-15-img.jpg",
                'is_free' => 0,
                'price' => 5499.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Linux for Network Engineers: Practical Linux with GNS3',
                'meta_description' => 'Linux for Network Engineers: Practical Linux with GNS3',
                'meta_keywords' => 'Linux for Network Engineers: Practical Linux with GNS3',
            ],
            [
                'category_id' => 4,
                'instructor_id' => 4,
                'name' => "Python Programming Masterclass",
                'slug' => "python-programming-masterclass",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-16-img.jpg",
                'is_free' => 0,
                'price' => 4599.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Python Programming Masterclass',
                'meta_description' => 'Python Programming Masterclass',
                'meta_keywords' => 'Python Programming Masterclass',
            ],
            [
                'category_id' => 4,
                'instructor_id' => 4,
                'name' => "C++: From Beginner to Expert",
                'slug' => "c-plus-from-beginner-to-expert",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-17-img.jpg",
                'is_free' => 0,
                'price' => 4999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'C++: From Beginner to Expert',
                'meta_description' => 'C++: From Beginner to Expert',
                'meta_keywords' => 'C++: From Beginner to Expert',
            ],
            [
                'category_id' => 4,
                'instructor_id' => 4,
                'name' => "Web Development, HTML, CSS, JavaScript",
                'slug' => "web-development-html-css-javascript",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-18-img.jpg",
                'is_free' => 0,
                'price' => 4999.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Web Development, HTML, CSS, JavaScript',
                'meta_description' => 'Web Development, HTML, CSS, JavaScript',
                'meta_keywords' => 'Web Development, HTML, CSS, JavaScript',
            ],
            [
                'category_id' => 5,
                'instructor_id' => 1,
                'name' => "Software Development Fundamentals",
                'slug' => "software-development-fundamentals",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-19-img.jpg",
                'is_free' => 0,
                'price' => 2599.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Software Development Fundamentals',
                'meta_description' => 'Software Development Fundamentals',
                'meta_keywords' => 'Software Development Fundamentals',
            ],
            [
                'category_id' => 5,
                'instructor_id' => 1,
                'name' => "Learn C# with Windows Forms",
                'slug' => "learn-c-with-windows-forms",
                'tiny_description' => $faker->sentence(50),
                'content' => join('<br><br>', $faker->paragraphs(rand(5, 10))),
                'requirements' => $faker->paragraph(),
                'what_you_will_learn_points' => $faker->sentences(6),
                'who_this_course_is_for_points' => $faker->paragraphs(3),
                'image' => "default-course-20-img.jpg",
                'is_free' => 0,
                'price' => 2599.00,
                'discount_flag' => 0,
                'discounted_price' => 0,
                'course_level' => "Beginner",
                'intro_video_provider' => "youtube",
                'intro_video_url' => "https://www.youtube.com/watch?v=1FOgP6Ndsgk",
                'course_status' => 1,
                'expiration_days' => null,
                'meta_title' => 'Learn C# with Windows Forms',
                'meta_description' => 'Learn C# with Windows Forms',
                'meta_keywords' => 'Learn C# with Windows Forms',
            ],
        ];
        foreach ($courses as $course) {
            $course['created_at'] = Carbon::now();
            $course['updated_at'] = Carbon::now();
            $course = Course::create($course);
            for ($i = 1; $i <= 5; $i++) {
                Faqs::create([
                    'course_id' => $course->id,
                    'question' => $faker->sentence($nbWords = 6, $variableNbWords = true) . '?',
                    'answer' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                ]);
            }
            $users = User::pluck('name', 'id')->toArray();
            for ($author_id = 2; $author_id <= 8; $author_id++) {
                Review::create([
                    'course_id' => $course->id,
                    'author_id' => $author_id,
                    'author_name' => $users[$author_id],
                    'comment' => $faker->text,
                    'rating' => rand(3, 5),
                ]);
            }
        }

        $curriculums = [
            1 => [
                [
                    'name' => 'SEO Fast-Track: How to get the essentials rights and understand the new rules',
                    'units' => [
                        [
                            'name' => 'Intro to SEO Strategy',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: SEO Fast-Track',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Which of the following is involved in the digital marketing process?',
                                    'options' => [
                                        'RSA' => 0,
                                        'Voice Broadcasting' => 0,
                                        'Podcasting' => 0,
                                        'All of the above' => 1
                                    ],
                                ],
                                [
                                    'title' => 'What is considered while creating a front page of the website or homepage?',
                                    'options' => [
                                        'References of other websites' => 0,
                                        'A brief elaboration about the company' => 0,
                                        'Logos portraying the number of awards won by the web designer' => 0,
                                        'None of the above' => 1
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Introduction to New Google Analytics 4 - GA4',
                    'units' => [
                        [
                            'name' => 'GA4: Advertising Performance',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Introduction',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Which of the following is incorrect about digital marketing?',
                                    'options' => [
                                        'Digital marketing can only be done offline' => 0,
                                        'Digital marketing cannot be done offline.' => 1,
                                        'Digital marketing requires electronic devices for promoting goods and services.' => 0,
                                        'In general, digital marketing can be understood as online marketing, web marketing, and e-mail marketing.' => 0
                                    ],
                                ],
                                [
                                    'title' => 'How many types of pillars do we have in digital marketing?',
                                    'options' => [
                                        '1' => 0,
                                        '2' => 1,
                                        '3' => 0,
                                        '4' => 0
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Instagram Business Strategy Guide',
                    'units' => [
                        [
                            'name' => 'A systemic approach to Instagram for Business',
                            'time' => '00:12:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Web CopyWriting',
                    'units' => [
                        [
                            'name' => 'How to Write Links People Want to Click On',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Web CopyWriting',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Which of the following is the correct depiction of Digital Marketing?',
                                    'options' => [
                                        'E-mail Marketing' => 0,
                                        'Social Media Marketing' => 0,
                                        'Web Marketing' => 0,
                                        'All of the above' => 1
                                    ],
                                ],
                                [
                                    'title' => "__________ doesn't fall under the category of digital marketing.",
                                    'options' => [
                                        'TV' => 0,
                                        'Billboard' => 0,
                                        'Radio' => 0,
                                        'All of the above' => 1
                                    ],
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    'name' => 'Web Analytics',
                    'units' => [
                        [
                            'name' => 'Track the results of your marketing campaign',
                            'time' => '00:12:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            2 => [
                [
                    'name' => 'Welcome',
                    'units' => [
                        [
                            'name' => 'Welcome to the Course!',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Getting Started',
                    'units' => [
                        [
                            'name' => 'What is a Dev Environment? (Your First Installation)',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'First Coding Steps: PHP',
                    'units' => [
                        [
                            'name' => 'Creating a New Theme',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Test: First Coding Steps',
                            'time' => '00:15:00',
                            'questions' => [
                                [
                                    'title' => 'The Quick draft section in WordPress is used for ___.',
                                    'options' => [
                                        'Creating mini-posts with titles and small details' => 1,
                                        'Editing posts' => 0,
                                        'Creating pages' => 0,
                                        'All of these' => 0
                                    ],
                                ],
                                [
                                    'title' => "Which of these are general settings of WordPress?",
                                    'options' => [
                                        'Site title' => 0,
                                        'Data format' => 0,
                                        'Time format' => 0,
                                        'All of these' => 1
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'WordPress Specific PHP',
                    'units' => [
                        [
                            'name' => 'The Famous "Loop" in WordPress',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: WordPress Specific',
                            'time' => '00:15:00',
                            'questions' => [
                                [
                                    'title' => 'Can writing settings be changed in WordPress?',
                                    'options' => [
                                        'Yes' => 1,
                                        'No' => 0,
                                    ],
                                ],
                                [
                                    'title' => "What is the default post Category for WordPress?",
                                    'options' => [
                                        'The first category added on WordPress' => 0,
                                        'Uncategorized' => 1,
                                        'No category' => 0,
                                        'None of these' => 0
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Pages',
                    'units' => [
                        [
                            'name' => 'Interior Page Template',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Building the Blog Section',
                    'units' => [
                        [
                            'name' => 'Blog Listing Page (index.php vs front-page.php)',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Building Blog Section',
                            'time' => '00:15:00',
                            'questions' => [
                                [
                                    'title' => 'What content of post can be displayed in the feed?',
                                    'options' => [
                                        'Full post' => 0,
                                        'Summary of post' => 0,
                                        'Optional both A and B' => 1,
                                        'None of these' => 0,
                                    ],
                                ],
                                [
                                    'title' => "What task does search engine visibility performs in WordPress?",
                                    'options' => [
                                        'Removes site visibility on google' => 1,
                                        'Discourage search engines from indexing the site' => 0,
                                        'Both' => 0,
                                        'None of these' => 0
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Events Post Type',
                    'units' => [
                        [
                            'name' => 'Custom Post Types',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Programs Post Type',
                    'units' => [
                        [
                            'name' => 'Creating Relationships Between Content',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Professors Post Type',
                    'units' => [
                        [
                            'name' => 'Professors Post Type',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            3 => [
                [
                    'name' => 'Introduction to SEO',
                    'units' => [
                        [
                            'name' => 'Introduction - SEO Action Plan!',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => "Wrap up",
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Keyword Research SEO',
                    'units' => [
                        [
                            'name' => 'Types of Searchers and their Search Intent',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => "What is Keyword Research? Why is it Important in SEO?",
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: Keyword Research",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'If a website’s search engine saturation with respect to a particular search engine is 20%, what does it mean?',
                                    'options' => [
                                        '20% of the web pages of the website have been indexed by the search engine' => 1,
                                        'Only 20% of the pages of the website will be indexed by the search engine' => 0,
                                        '20% of the websites pages will never be indexed' => 0,
                                        'The website ranks in the first 20% of all websites indexed by the search engine for its most important search terms' => 0,
                                    ],
                                ],
                                [
                                    'title' => "10 people do a web search. In response, they see links to a variety of web pages. Three of the 10 people choose one particular link. That link then has a _______ click through rate.",
                                    'options' => [
                                        'less than 30%' => 0,
                                        '30 percent' => 1,
                                        'more than 30%' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'On-Page SEO',
                    'units' => [
                        [
                            'name' => 'Analyzing SERPs before creating content',
                            'time' => '00:06:00',
                        ],
                        [
                            'name' => "What's the Present Big Thing in SEO",
                            'time' => '00:05:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Google Search: An insider view',
                    'units' => [
                        [
                            'name' => 'How does Google search work?',
                            'time' => '00:03:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Google Search',
                            'time' => '00:09:00',
                            'questions' => [
                                [
                                    'title' => 'What does the 302 server response code signify',
                                    'options' => [
                                        'It signifies conflict, too many people wanted the same file at the same time' => 0,
                                        'The page has been permanently removed' => 0,
                                        'The method you are using to access the file is not allowed' => 0,
                                        'The page has temporarily moved' => 1,
                                        'What you requested is just too big to process' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Which of the following statements about FFA pages are true?",
                                    'options' => [
                                        'They are greatly beneficial to SEO' => 0,
                                        'They are also called link farms' => 1,
                                        'They are paid listings' => 0,
                                        'They contain numerous inbound links' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Pagespeed SEO: Exclusively for WordPress',
                    'units' => [
                        [
                            'name' => 'How to do Page Speed test - The Right way?',
                            'time' => '00:04:00',
                        ],
                        [
                            'name' => 'How to Backup & Restore your WordPress websites?',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            4 => [
                [
                    'name' => 'Introduction',
                    'units' => [
                        [
                            'name' => 'Introduction',
                            'time' => '00:09:00',
                        ],
                        [
                            'name' => "What is Social Media Marketing & Management?",
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: Introduction",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'What is Social Media Marketing?',
                                    'options' => [
                                        'a way to communicate with customers on social media platforms to increase the performance of the business' => 1,
                                        'Software' => 0,
                                        'Hardware' => 0,
                                        'All of the above' => 0,
                                    ],
                                ],
                                [
                                    'title' => "What social media marketing do?",
                                    'options' => [
                                        'It can help to communicate with customers in a less time-consuming manner.' => 0,
                                        'It can help to create visual interaction between products and customers.' => 0,
                                        'It can help to advertise a product and services to many customers at once.' => 1,
                                        'All of the above' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Market Research',
                    'units' => [
                        [
                            'name' => 'Market Research Explained',
                            'time' => '00:10:00',
                        ],
                        [
                            'name' => "Find Target Audience (Ideal Customer)",
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'STRATEGY',
                    'units' => [
                        [
                            'name' => 'Why You Need a Strategy',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: Strategy",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Social media marketing focuses on ___.',
                                    'options' => [
                                        'Social platform' => 1,
                                        'Individual shop' => 0,
                                        'Whole sale' => 0,
                                        'All of the above' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Social media marketing is one of the best advertising resources to grab consumer's attention",
                                    'options' => [
                                        'True' => 1,
                                        'False' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Goal Setting',
                    'units' => [
                        [
                            'name' => 'S.M.A.R.T Goals',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Specific',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Branding & Design',
                    'units' => [
                        [
                            'name' => 'The Structure of Branding',
                            'time' => '00:15:00',
                        ],
                        [
                            'name' => 'Branding vs Marketing',
                            'time' => '00:10:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Binding & Design',
                            'time' => '00:05:00',
                            'questions' => [
                                [
                                    'title' => 'Identify the platform for Social media marketing?',
                                    'options' => [
                                        'Instagram' => 0,
                                        'Twitter' => 0,
                                        'Facebook' => 0,
                                        'All of the above' => 1,
                                    ],
                                ],
                                [
                                    'title' => "What are the most essential 7 M's in marketing?",
                                    'options' => [
                                        'Man, Money, Machine, Market, Management, Message, Mission' => 1,
                                        'mindset, measure, model, map, make, modify, and monetize' => 0,
                                        'Both A and B' => 0,
                                        'None of the above' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
            ],
            5 => [
                [
                    'name' => 'A Quick Start to Enable Your After Effects Skills',
                    'units' => [
                        [
                            'name' => 'Getting ready to start your first animation',
                            'time' => '00:10:00',
                        ],
                        [
                            'name' => "Dive in for beginners: Getting the Graphics",
                            'time' => '00:15:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Working in After Effects CC: An overview of the Interface and Keyboard Shortcuts',
                    'units' => [
                        [
                            'name' => 'After Effects Interface - Workspaces',
                            'time' => '00:10:00',
                        ],
                        [
                            'name' => "Frames & Seconds on the Timeline",
                            'time' => '00:15:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: Working in after effects CC",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'What is a shortcut key to create a new document?',
                                    'options' => [
                                        'Ctrl+M' => 0,
                                        'Ctrl+T' => 0,
                                        'Ctrl+I' => 0,
                                        'Ctrl+N' => 1,
                                    ],
                                ],
                                [
                                    'title' => "From where I can change the appearance of indesign?",
                                    'options' => [
                                        'Workspace' => 0,
                                        'Preference' => 1,
                                        'Layout' => 0,
                                        'Window' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Animating Illustration in After Effects CC',
                    'units' => [
                        [
                            'name' => 'Shopping Box Animation: Import into After Effects',
                            'time' => '00:05:00',
                        ],
                        [
                            'name' => 'Shopping Box Animation: Animating the illustration',
                            'time' => '00:05:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Staring up with Speed Control',
                    'units' => [
                        [
                            'name' => 'How to Ease your animation on a Motion Path',
                            'time' => '00:05:00',
                        ],
                        [
                            'name' => 'Controlling the speed on a motion path - Speed Graph',
                            'time' => '00:05:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Starting up with Speed Control',
                            'time' => '00:01:00',
                            'questions' => [
                                [
                                    'title' => 'Adobe Indesign initial release year is _______?',
                                    'options' => [
                                        '1992' => 0,
                                        '1996' => 0,
                                        '1999' => 1,
                                        '2001' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Adobe indesign is ____________________software.",
                                    'options' => [
                                        'Desktop Publishing' => 1,
                                        'Image Editing' => 0,
                                        'Illustration' => 0,
                                        'All of these' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Start animating Shapes and Type Layers',
                    'units' => [
                        [
                            'name' => 'How to Create and Edit Text Layers',
                            'time' => '00:05:00',
                        ],
                        [
                            'name' => 'How to Create and Edit Shape Layers',
                            'time' => '00:05:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            6 => [
                [
                    'name' => 'Get started with web development',
                    'units' => [
                        [
                            'name' => 'Introduction to the Program',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => "Introduction to the course",
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Introduction to HTML and CSS',
                    'units' => [
                        [
                            'name' => 'What is Hyper Text Markup Language?',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => "HTML documents",
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: Introduction to HTML and CSS",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Identify the most accurate statement about the application of XML -',
                                    'options' => [
                                        'XML is used to describe hierarchically organized information.' => 1,
                                        'XML must be used to produce XML and HTML output.' => 0,
                                        'XML cannot specify or contain presentation information.' => 0,
                                        'XML performs the conversion of information between different e-business applications.' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Which of the following is not a connectivity protocol to connect and access a database?",
                                    'options' => [
                                        'XML database connectivity' => 1,
                                        'Java database connectivity' => 0,
                                        'Open database connectivity' => 0,
                                        'Simple object access protocol' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'UI Frameworks',
                    'units' => [
                        [
                            'name' => 'Working with libraries',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Introduction to responsive design',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: UI Frameworks",
                            'time' => '00:05:00',
                            'questions' => [
                                [
                                    'title' => 'In an HTML document, the correct sequence of the tags for starting a web page is:',
                                    'options' => [
                                        'Head, Title, HTML, Body' => 1,
                                        'HTML, Title, Head, Body' => 0,
                                        'HTML, Head, Title, Body' => 0,
                                        'HTML, Body, title, Head' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Which of the following are correct statements with respect to XML?",
                                    'que_description' => "<p>(i) It is used to display data only.</p><p>(ii) XML can be used as a database.</p><p>(iii) XPATH is used to store the IP address of the server.</p><p>(iv) XLL definition is used along with XML to specify the links with other documents.<br></p>",
                                    'options' => [
                                        'Only (i) and (ii)' => 1,
                                        'Only (i), (ii) and (iii)' => 0,
                                        'Only (ii), (iii) and (iv)' => 0,
                                        'Only (ii) and (iv)' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'End-of-Course Graded Assessment',
                    'units' => [
                        [
                            'name' => 'Course 1 Recap: Introduction to Web Development',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Congratulations, you have completed Introduction to Web Development',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            7 => [
                [
                    'name' => 'The first steps',
                    'units' => [
                        [
                            'name' => 'Introduction to laravel and MVC',
                            'time' => '00:15:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Windows - Local Environment Setup',
                    'units' => [
                        [
                            'name' => 'New - Using MySQL',
                            'time' => '00:05:00',
                        ],
                        [
                            'name' => "New- Installing Node.js",
                            'time' => '00:05:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'MAC- Local Environment Setup',
                    'units' => [
                        [
                            'name' => 'NEW - PHP Upgrade',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'New - Tools and Installing Laravel',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => "Module Quiz: local Environment Setup",
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Which artisan command is used to remove the compiled class file.',
                                    'options' => [
                                        'clear-compiled' => 1,
                                        'clear compiled' => 0,
                                        'compiled:clear' => 0,
                                        'clear:all' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Which method breaks the collection into multiple, smaller collections of a given size",
                                    'options' => [
                                        'split()' => 0,
                                        'chunk()' => 1,
                                        'explode()' => 0,
                                        'break()' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Laravel Fundamentals - Routes',
                    'units' => [
                        [
                            'name' => 'New UPDATE - Serving our App',
                            'time' => '00:30:00',
                        ],
                        [
                            'name' => 'Naming Routes',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Laravel Fundamentals-Routes',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'Which method returns the average value of a given key ?',
                                    'options' => [
                                        'average()' => 0,
                                        'avg()' => 1,
                                        'median()' => 0,
                                        'avg_val()' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Bootstrap directory in Laravel is used to",
                                    'options' => [
                                        'Initialize a Laravel application' => 1,
                                        'Call laravel library functions' => 0,
                                        'Load the configuration files' => 0,
                                        'Load laravel classes and models' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Laravel Fundamentals - Controllers',
                    'units' => [
                        [
                            'name' => 'Intro to chapter with Edwin',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Creating Controllers',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
            ],
            8 => [
                [
                    'name' => 'Course Introduction',
                    'units' => [
                        [
                            'name' => 'Course Introduction and Overview',
                            'time' => '00:10:00',
                        ],
                        [
                            'name' => 'Beginner-Friendly Labs',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Overview and Benefits of Computer Networks',
                    'units' => [
                        [
                            'name' => 'Some Basic Computer Networking Rules',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => "Peer-to-Peer vs. Client-Server Architecture",
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Course Primer: How Computer Networks Work',
                    'units' => [
                        [
                            'name' => 'Section Introduction',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Introduction to Computer Networking Protocols',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => []
                ],
                [
                    'name' => 'Network Topologies',
                    'units' => [
                        [
                            'name' => 'Section Introduction',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Wired Network Topologies',
                            'time' => '00:20:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Network Topologies',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'What does PoP stand for?',
                                    'options' => [
                                        'Pre Office Protocol' => 0,
                                        'Post Office Protocol' => 1,
                                        'Protocol of Post' => 0,
                                        'None of the above' => 0,
                                    ],
                                ],
                                [
                                    'title' => "What is the port number of PoP?",
                                    'options' => [
                                        '35' => 0,
                                        '43' => 0,
                                        '110' => 1,
                                        '25' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Networking Devices',
                    'units' => [
                        [
                            'name' => 'Section Introduction',
                            'time' => '00:20:00',
                        ],
                        [
                            'name' => 'Network Interface Cards (NICs)',
                            'time' => '00:30:00',
                        ],
                    ],
                    'quiz_list' => [
                        [
                            'name' => 'Module Quiz: Networking Devices',
                            'time' => '00:10:00',
                            'questions' => [
                                [
                                    'title' => 'What is the number of layers in the OSI model?',
                                    'options' => [
                                        '2 layers' => 0,
                                        '4 layers' => 0,
                                        '7 layers' => 1,
                                        '9 layers' => 0,
                                    ],
                                ],
                                [
                                    'title' => "Identify the layer which provides service to the user.",
                                    'options' => [
                                        'Session layer' => 0,
                                        'Application layer' => 1,
                                        'Presentation error' => 0,
                                        'Physical layer' => 0,
                                    ],
                                ],
                            ]
                        ],
                    ]
                ],
            ],
        ];

        $chapter_urls = [
            1 => 'https://www.youtube.com/embed/SGHjY_tfo7U',
            2 => 'https://www.youtube.com/embed/DqbA3IAciZ0',
            3 => 'https://www.youtube.com/embed/P8hhLu5uE5A',
            4 => 'https://www.youtube.com/embed/P8hhLu5uE5A',
            5 => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
            6 => 'https://www.youtube.com/embed/HD6Vb0-BqBI',
            7 => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
            8 => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
        ];
        foreach ($curriculums as $course_id => $sections) {
            foreach ($sections as $sectionData) {
                $section = Sections::create(['course_id' => $course_id, 'name' => $sectionData['name'], 'is_active' => 1]);
                $section_id = $section->id;
                foreach ($sectionData['units'] as $unitData) {
                    $unit_content = "<p>" . $faker->paragraph(6) . "</p><br><p>" . $faker->paragraph(12). "</p><br><p>" . $faker->paragraph(10). "</p>";
                    $unit_short_content = "<p>". $faker->paragraph(5) . "</p>";

                    $unit = Units::create(['course_id' => $course_id, 'section_id' => $section_id, 'name' => $unitData['name'], 'slug' => str_slug($unitData['name']), 'is_active' => 1, 'time' => $unitData['time'] ?? null, 'short_content' => $unit_short_content, 'content' => $unit_content,
                        'lesson_type' => 'youtube', 'lesson_media_url' => $chapter_urls[$course_id]]);
                    for ($i = 1; $i <= 5; $i++) {
                        UnitFaq::create([
                            'unit_id' => $unit->id,
                            'question' => $faker->sentence($nbWords = 6, $variableNbWords = true) . '?',
                            'answer' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                        ]);
                    }
                }
                foreach ($sectionData['quiz_list'] as $quizData) {
                    $quiz = Quiz::create(['course_id' => $course_id, 'section_id' => $section_id, 'name' => $quizData['name'], 'slug' => str_slug($quizData['name']), 'is_active' => 1, 'time' => $unitData['time'] ?? null, 'retake' => 5]);
                    foreach ($quizData['questions'] as $questionData) {
                        $question = QuizQuestion::create([
                            'course_id' => $course_id,
                            'section_id' => $section_id,
                            'quiz_id' => $quiz->id,
                            'title' => $questionData['title'],
                            'que_description' => $questionData['que_description'] ?? null,
                            'type' => 'single_choice',
                        ]);
                        $option_id = 1;
                        foreach ($questionData['options'] as $option_content => $write_answer) {
                            QuizQuestionOption::create([
                                'quiz_id' => $quiz->id,
                                'question_id' => $question->id,
                                'option_id' => $option_id,
                                'content' => $option_content,
                                'is_correct_answer' => $write_answer,
                            ]);
                            $option_id++;
                        }
                    }
                }
            }
        }

        for ($courseId = 9; $courseId <= 20; $courseId++) {
            $fakeSections = $faker->sentences(4);
            foreach ($fakeSections as $fakeSection) {
                $section = Sections::create(['course_id' => $courseId, 'name' => $fakeSection, 'is_active' => 1]);
                $section_id = $section->id;

                $fakeUnits = $faker->sentences(rand(1, 2));
                foreach ($fakeUnits as $fakeUnit) {
                    $unit_content = "<p>" . $faker->paragraph(6) . "</p><br><p>" . $faker->paragraph(12). "</p><br><p>" . $faker->paragraph(10). "</p>";
                    $unit_short_content = "<p>". $faker->paragraph(5) . "</p>";

                    $unit = Units::create(['course_id' => $courseId, 'section_id' => $section_id, 'name' => $fakeUnit, 'slug' => $faker->slug, 'is_active' => 1, 'time' => '00:10:00', 'short_content' => $unit_short_content, 'content' => $unit_content,
                        'lesson_type' => 'youtube', 'lesson_media_url' => 'https://www.youtube.com/embed/1FOgP6Ndsgk']);
                    for ($i = 1; $i <= 5; $i++) {
                        UnitFaq::create([
                            'unit_id' => $unit->id,
                            'question' => str_replace('.', '?', $faker->sentence($nbWords = 6, $variableNbWords = true)),
                            'answer' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                        ]);
                    }
                }

                $quiz = Quiz::create(['course_id' => $courseId, 'section_id' => $section_id, 'name' => $faker->sentence(8), 'slug' => $faker->slug, 'is_active' => 1, 'time' => '00:20:00', 'retake' => 5]);
                $questions = $faker->sentences(rand(3, 5));
                foreach ($questions as $question) {
                    $question = QuizQuestion::create([
                        'course_id' => $courseId,
                        'section_id' => $section_id,
                        'quiz_id' => $quiz->id,
                        'title' => 'Quiz: '.$question,
//                        'que_description' => $faker->paragraph,
                        'type' => 'single_choice',
                    ]);
                    $options = $faker->sentences(4);
                    $right_answer = rand(1, 4);
                    $option_id = 1;
                    foreach ($options as $option_content) {
                        QuizQuestionOption::create([
                            'quiz_id' => $quiz->id,
                            'question_id' => $question->id,
                            'option_id' => $option_id,
                            'content' => $option_content,
                            'is_correct_answer' => ($right_answer == $option_id) ? 1 : 0,
                        ]);
                        $option_id++;
                    }
                }
            }
        }
    }
}
