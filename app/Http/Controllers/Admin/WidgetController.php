<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontMenuItem;
use App\Models\Pages;
use App\Models\Translation;
use App\Models\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $widgets = Widget::all();
        return view('admin.widgets.index', compact('widgets'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $widget = Widget::findOrFail($id);
        return view('admin.widgets.edit', compact('widget'));
    }

    public function update(Request $request, $id)
    {
        $widget = Widget::findOrFail($id);
        $requestData = $request->all();
        if (empty($requestData['title'][config('system_default_language')]) || empty(strip_tags($requestData['description'][config('system_default_language')]))) {
            return redirect()->back()->with('error', __('backend.menu_managers.error.please_insert_default_language_data'));
        }
        if(isset($requestData['image'])){
            $requestData['image'] = uploadFile($requestData['image'], 'widgets', $widget->image);
        }
        $widget->update($requestData);
        return redirect()->route('admin.widgets')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function getMenuManagerPage(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $menu_items = FrontMenuItem::orderByRaw('ISNULL(sort), sort ASC')->get();
        $pages = Pages::select('id', 'name', 'slug')->get();
        return view('admin.menu-manager.index', compact('menu_items', 'pages'));
    }

    public function storeMenuItem(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->except('_token');
        if (empty($requestData)) {
            return redirect()->back();
        }
        if (isset($requestData['custom_pages'])) {
            foreach ($requestData['custom_pages'] as $custom_page_id) {
                $pageDetails = Pages::find($custom_page_id);
                FrontMenuItem::create([
                    'label' => $pageDetails->name,
                    'link' => 'details/' . $pageDetails->slug,
                ]);

                Translation::create([
                    'status' => 1,
                    'locale' => 'en',
                    'group' => 'frontend',
                    'key' => 'nav.custom_menu_item.'.str_slug($pageDetails['name'], '_'),
                    'value' => $pageDetails['name'],
                ]);
            }
        } elseif (!empty($request->menu_item_id)) {
            unset($requestData['menu_item_id']);
            FrontMenuItem::where('id', $request->menu_item_id)->update($requestData);
        } else {
            FrontMenuItem::create($requestData);
            Translation::create([
                'status' => 1,
                'locale' => 'en',
                'group' => 'frontend',
                'key' => 'nav.custom_menu_item.'.str_slug($requestData['label'], '_'),
                'value' => $requestData['label'],
            ]);
        }
        return redirect()->route('admin.menu_manager')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function deleteMenuItem($id): \Illuminate\Http\RedirectResponse
    {
        FrontMenuItem::destroy($id);
        return redirect()->route('admin.menu_manager')->with('success', __('global.flash_message.data_deleted_successfully'));
    }

    public function updateMenuItemSort(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();
        foreach ($requestData['sortMenuItems'] as $sort_order => $menuItemId) {
            FrontMenuItem::where('id', $menuItemId)->update(['sort' => $sort_order]);
        }
        return response()->json(['status' => true, 'message' => __('global.flash_message.data_updated_successfully')]);
    }
}
