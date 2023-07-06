<?php

namespace App\Http\ViewComposer;

use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Interfaces\Front\PageRepositoryInterface;
use App\Models\FrontMenuItem;
use Illuminate\View\View;

class FrontViewComposer
{
    protected $categoryRepository, $pageRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, PageRepositoryInterface $pageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepository->getActiveCategories();
        $pages = $this->pageRepository->getAllPages();
        $menu_items = FrontMenuItem::orderByRaw('ISNULL(sort), sort ASC')->get();
        $view->with([
            'categories' => $categories,
            'pages' => $pages,
            'menu_items' => $menu_items,
        ]);
    }
}
