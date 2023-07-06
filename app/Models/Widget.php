<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    const DIMENSIONS = [
        'promotional_section_one_widget' => '550x561',
        'promotional_section_two_widget' => '480x615',
        'our_goal_or_vision_section_widget' => '1110x500',
        'video_promotion_section_widget',
    ];

    const PREVIEW_IMAGE = [
        'promotional_section_one_widget' => 'widget_demo/promotional_section_one_widget.png',
        'promotional_section_two_widget' => 'widget_demo/promotional_section_two_widget.png',
        'our_goal_or_vision_section_widget' => 'widget_demo/our_goal_or_vision_section_widget.png',
        'video_promotion_section_widget' => 'widget_demo/video_promotion_section_widget.png',
        'promotional_section_three_widget' => 'widget_demo/promotional_section_three_widget.png',
    ];

    protected $table = 'widgets';

    protected $primaryKey = 'id';

    protected $fillable = ['identifier','title', 'description', 'image', 'video_url'];

    protected $casts = ['title' => 'array', 'description' => 'array'];
}
