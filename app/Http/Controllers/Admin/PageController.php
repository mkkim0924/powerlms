<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PagesRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pagesRepository;

    public function __construct(PagesRepositoryInterface $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }
    public function index()
    {
        $pagedetails = $this->pagesRepository->getAllPages();
        return view('admin.page.index', compact('pagedetails'));
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|unique:pages|max:255',
        ]);

        $this->pagesRepository->storePage($request);
        return redirect()->route('admin.page')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $page = $this->pagesRepository->getPagesDetails($id);
        return view('admin.page.edit', compact('page'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'slug' => 'required|unique:pages,slug,' . $request->id,
        ]);
        $this->pagesRepository->updatePage($request, $id);
        return redirect()->route('admin.page')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->pagesRepository->delete($id);
        return redirect()->route('admin.page');
    }
}
