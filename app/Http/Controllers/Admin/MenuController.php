<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontMenuItem;
use App\Models\Pages;
use App\Models\Translation;
use Illuminate\Http\Request;
use Barryvdh\TranslationManager\Manager;

class MenuController extends Controller
{

    /** @var \Barryvdh\TranslationManager\Manager  */
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $default_items = config('menu_options');

        $menu_items = FrontMenuItem::orderByRaw('ISNULL(sort), sort ASC')->get();
        $pages = Pages::select('id', 'name', 'slug')->get();

        $default_menu_items = $menu_items->filter(function($item)
        {
            if($item->source_type == 'default')
            {
                return $item->source_type_id;
            }
        });
        $default_menu_items = collect($default_menu_items->pluck('source_type_id'))->toArray();

        $default_menu_pages = $menu_items->filter(function($item)
        {
            if($item->source_type == 'page')
            {
                return $item->source_type_id;
            }
        });
        $default_menu_pages = collect($default_menu_pages->pluck('source_type_id'))->toArray();

        return view('admin.menu-manager.index', compact('menu_items', 'pages','default_items',
        'default_menu_items','default_menu_pages'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->except('_token');
        if (empty($requestData)) {
            return redirect()->back();
        }
        if (isset($requestData['custom_pages'])) {
            foreach ($requestData['custom_pages'] as $custom_page_id) {
                $pageDetails = Pages::find($custom_page_id);
                $select_max_order = FrontMenuItem::max('sort');
                $select_max_order = (int)$select_max_order;
                FrontMenuItem::create([
                    'label' => $pageDetails->name,
                    'link' => 'details/' . $pageDetails->slug,
                    'source_type' => 'page',
                    'source_type_id' =>$pageDetails->id,
                    'sort'=> ++$select_max_order
                ]);

                Translation::create([
                    'status' => 1,
                    'locale' => 'en',
                    'group' => 'frontend',
                    'key' => 'nav.custom_menu_item.'.str_slug($pageDetails['name'], '_'),
                    'value' => $pageDetails['name'],
                ]);
                $this->manager->exportTranslations("frontend",false);
            }
        } else if (isset($requestData['default_items'])) {
            foreach ($requestData['default_items'] as $default_item_id) {
                $select_max_order = FrontMenuItem::max('sort');
                $select_max_order = (int)$select_max_order;
                FrontMenuItem::create([
                    'label' => config('menu_options.'.$default_item_id),
                    'link' => strtolower(config('menu_options.'.$default_item_id)),
                    'source_type' => 'default',
                    'source_type_id' =>$default_item_id,
                    'sort'=> ++$select_max_order
                ]);

                // Translation::create([
                //     'status' => 1,
                //     'locale' => 'en',
                //     'group' => 'frontend',
                //     'key' => 'nav.custom_menu_item.'.str_slug($pageDetails['name'], '_'),
                //     'value' => $pageDetails['name'],
                // ]);
            }
        } elseif (!empty($request->menu_item_id)) {
            unset($requestData['menu_item_id']);
            $updateData = array_values($requestData['update_data'])[0];
            if (!empty($updateData['label'])){
                FrontMenuItem::where('id', $request->menu_item_id)->update();
            }else{
                return redirect()->back()->with('error', __('validation.required', [
                    'attribute' => strtolower(__('backend.menu_managers.label.label')),
                ]));
            }
        } else {
            $this->validate($request, [
               'label' => 'required',
               'link' => 'required'
            ], [
                'label.required' => __('validation.required', [
                    'attribute' => strtolower(__('backend.menu_managers.label.label')),
                ]),
                'link.required' => __('validation.required', [
                    'attribute' => strtolower(__('backend.menu_managers.label.url')),
                ]),
            ]);
            $select_max_order = FrontMenuItem::max('sort');
            $select_max_order = (int)$select_max_order;
            $requestData['source_type'] = 'custom';
            $requestData['source_type_id'] = null;
            $requestData['sort'] = ++$select_max_order;
            FrontMenuItem::create($requestData);

            Translation::create([
                'status' => 1,
                'locale' => 'en',
                'group' => 'frontend',
                'key' => 'nav.custom_menu_item.'.str_slug($requestData['label'], '_'),
                'value' => $requestData['label'],
            ]);

            $this->manager->exportTranslations("frontend",false);
        }
        return redirect()->route('admin.menu_manager')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        FrontMenuItem::destroy($id);
        return redirect()->route('admin.menu_manager')->with('success', __('global.flash_message.data_deleted_successfully'));
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();
        foreach ($requestData['sortMenuItems'] as $sort_order => $menuItemId) {
            FrontMenuItem::where('id', $menuItemId)->update(['sort' => $sort_order]);
        }
        return response()->json(['status' => true, 'message' => __('global.flash_message.data_updated_successfully')]);
    }
}
