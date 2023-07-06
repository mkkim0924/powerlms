<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    protected $table = 'site_configuration';
    const IMAGE_DIMENSIONS = [
        'logo' => '430x100',
        'logo_white' => '430x100',
        'admin_logo' => '430x100',
        'favicon_icon' => '16x16',
        'certificate_background_image' => '1400x1000',
        'certificate_signature_image' => '95x15',
    ];
    const SECTIONS = [
        'layout1' => ['banner_section', 'statistics_section', 'promotional_section_one_widget', 'popular_courses_section', 'promotional_section_two_widget', 'website_feature_section', 'trending_categories_section', 'upcoming_webinar_section', 'top_rated_courses_section', 'student_testimonial_section', 'bundle_courses_section', 'become_a_teacher_section', 'our_goal_or_vision_section_widget', 'video_promotion_section_widget', 'partner_companies_section', 'learning_points_section', 'blogs_section', 'promotional_section_three_widget'],
        'layout2' => ['banner_section', 'promotional_section_one_widget', 'trending_categories_section', 'bundle_courses_section', 'promotional_section_three_widget', 'top_rated_courses_section', 'upcoming_webinar_section', 'popular_courses_section', 'promotional_section_two_widget', 'student_testimonial_section', 'become_a_teacher_section', 'blogs_section'],
        'layout3' => ['banner_section', 'popular_courses_section', 'promotional_section_two_widget', 'trending_categories_section', 'top_rated_courses_section', 'website_feature_section', 'bundle_courses_section', 'upcoming_webinar_section', 'video_promotion_section_widget', 'our_goal_or_vision_section_widget', 'student_testimonial_section', 'become_a_teacher_section', 'blogs_section'],
        'layout4' => ['banner_section', 'popular_courses_section', 'our_goal_or_vision_section_widget', 'upcoming_webinar_section', 'website_feature_section', 'bundle_courses_section', 'video_promotion_section_widget', 'promotional_section_two_widget', 'statistics_section', 'top_rated_courses_section', 'student_testimonial_section', 'blogs_section', 'promotional_section_three_widget'],
        'layout5' => ['banner_section', 'promotional_section_two_widget', 'website_feature_section', 'trending_categories_section', 'statistics_section', 'popular_courses_section', 'video_promotion_section_widget', 'upcoming_webinar_section', 'bundle_courses_section', 'top_rated_courses_section', 'student_testimonial_section', 'blogs_section', 'become_a_teacher_section'],
        'layout6' => ['banner_section', 'trending_categories_section', 'promotional_section_one_widget', 'website_feature_section', 'top_rated_courses_section', 'upcoming_webinar_section', 'promotional_section_three_widget', 'bundle_courses_section', 'promotional_section_two_widget', 'statistics_section', 'popular_courses_section', 'video_promotion_section_widget', 'our_goal_or_vision_section_widget', 'student_testimonial_section', 'become_a_teacher_section', 'blogs_section'],
        'layout7' => ['banner_section', 'popular_courses_section', 'trending_categories_section', 'video_promotion_section_widget', 'upcoming_webinar_section', 'bundle_courses_section', 'promotional_section_two_widget', 'statistics_section', 'top_rated_courses_section', 'website_feature_section', 'our_goal_or_vision_section_widget', 'blogs_section', 'student_testimonial_section', 'become_a_teacher_section'],
        'layout8' => ['banner_section', 'statistics_section', 'promotional_section_one_widget', 'trending_categories_section', 'popular_courses_section', 'promotional_section_three_widget', 'top_rated_courses_section', 'video_promotion_section_widget', 'upcoming_webinar_section', 'bundle_courses_section', 'our_goal_or_vision_section_widget', 'student_testimonial_section', 'become_a_teacher_section', 'blogs_section'],
        'layout9' => ['banner_section', 'promotional_section_one_widget', 'learning_points_section', 'trending_categories_section', 'website_feature_section', 'popular_courses_section', 'student_testimonial_section', 'upcoming_webinar_section', 'promotional_section_two_widget', 'video_promotion_section_widget', 'top_rated_courses_section', 'bundle_courses_section', 'statistics_section', 'our_goal_or_vision_section_widget', 'blogs_section', 'become_a_teacher_section'],
    ];

    protected $fillable = ['config_group_id', 'identifier_key', 'configuration_title', 'note', 'configuration_value', 'identifier', 'control_type', 'parent_config_id', 'documentation_redirect_text', 'documentation_redirect_url'];


    public function childConfigurations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SiteConfiguration::class, 'parent_config_id', 'id');
    }
}
