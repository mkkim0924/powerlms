<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewObserver
{
    public function created(Review $review)
    {
        $data = Review::where('course_id', $review->course_id)->select(DB::raw('avg(rating) as average_rating'), DB::raw('count(*) as total_reviews'))->first();
        Course::where('id', $review->course_id)->update(['average_rating' => round($data['average_rating'], 1), 'total_reviews' => $data['total_reviews']]);
    }

    public function updated(Review $review)
    {
        $data = Review::where('course_id', $review->course_id)->select(DB::raw('avg(rating) as average_rating'), DB::raw('count(*) as total_reviews'))->first();
        Course::where('id', $review->course_id)->update(['average_rating' => round($data['average_rating'], 1), 'total_reviews' => $data['total_reviews']]);
    }
}
