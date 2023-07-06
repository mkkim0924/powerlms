<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\Admins;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blog = $this->blogRepository->getAllBlogs();
        return view('admin.blog.index', compact('blog'));
    }

    public function create()
    {
        $categories = $this->blogRepository->getCategoryTitles();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:blogs|max:255',
            'title' => 'required',
        ]);
        $this->blogRepository->storeBlogData($request);
        return redirect()->route('admin.blog')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $categories = $this->blogRepository->getCategoryTitles();
        $blog = $this->blogRepository->getBlogDetails($id);
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'slug' => 'required|unique:blogs,slug,' . $request->id,
        ]);
        $this->blogRepository->updateBlogData($request, $id);
        return redirect()->route('admin.blog')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->blogRepository->deleteBlog($id);
        return redirect()->route('admin.blog');
    }
}
