<?php

namespace App\Repositories\Front;

use App\Interfaces\Front\PageRepositoryInterface;
use App\Models\Pages;

class PageRepository implements PageRepositoryInterface
{
    public function getAllPagesBySlug($slug)
    {
        return Pages::where('slug', $slug)->first();
    }

    public function getAllPages()
    {
        return Pages::get();
    }


}
