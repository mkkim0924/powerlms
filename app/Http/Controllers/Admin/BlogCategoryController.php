<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $category = $this->blogRepository->getAllCategory();
        return view('admin.blog_category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => "required|unique:blog_categories,slug",
        ]);

        $this->blogRepository->storeCategoryData($request);
        return redirect()->route('admin.blog_categories')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $category = $this->blogRepository->getCategoryDetails($id);
        return view('admin.blog_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|unique:blog_categories,slug,' . $request->id,
        ]);

        $this->blogRepository->updateCategoryData($request, $id);
        return redirect()->route('admin.blog_categories')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->blogRepository->delete($id);
        return redirect()->route('admin.blog_categories');
    }
}
