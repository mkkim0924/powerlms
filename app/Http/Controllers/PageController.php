<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\PageRepositoryInterface;

class PageController extends Controller
{

    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }
    public function pages($slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $page = $this->pageRepository->getAllPagesBySlug($slug);
        if (isset($page)){
            return view('front-end.pages.details', compact('page'));
        }else{
            abort(404);
        }
    }

}
