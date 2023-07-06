<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review()
    {
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.review',compact('widgets'));
    }
}
