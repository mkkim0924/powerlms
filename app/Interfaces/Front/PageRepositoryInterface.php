<?php

namespace App\Interfaces\Front;

interface PageRepositoryInterface
{
    public function getAllPagesBySlug($slug);

    public function getAllPages();
}
