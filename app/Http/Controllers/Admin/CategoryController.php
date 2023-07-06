<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(categoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        return view('admin.category.create');
    }

    public function index(): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryRepository->getAllCategory();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => "required",
            'slug' => "required|unique:categories",
        ]);
        $this->categoryRepository->storeCategoryData($request);
        return redirect()->route('admin.categories')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $category = $this->categoryRepository->getCategoryDetails($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => "required",
        ]);
        $this->categoryRepository->updateCategoryData($request, $id);
        return redirect()->route('admin.categories')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->categoryRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }
}
