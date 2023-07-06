<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Madnest\Madzipper\Madzipper;

class UpdateController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.update.index');
    }

    public function listFiles(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $this->validate($request, [
            'file' => 'required|mimes:zip'
        ]);
        $file = $request->file('file');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/updates/', $file_name);
        $is_verified = false;
        $zipper = new Madzipper();
        $checkFiles = $zipper->make(public_path() . '/updates/' . $file_name)->listFiles();
        foreach ($checkFiles as $item) {
            $item = Arr::last(explode('/', $item));
            if ($item == md5('PowerLMS') . '.key') {
                $is_verified = true;
            }
        }
        if ($is_verified == true) {
            $zipper = new Madzipper();
            $files = $zipper->make(public_path() . '/updates/' . $file_name)->listFiles();
            return view('admin.update.file-list', compact('files', 'file_name'));
        } else {
            File::delete('updates/'.$file_name);
            return redirect()->route('admin.update_theme')->with('error', __('backend.update.error.unverified_update_files'));
        }
    }

    public function updateTheme(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '-1');

        $file_name = $request->file_name;
        if ($request->submit == 'cancel') {
            File::delete('updates/'.$file_name);
            return redirect()->route('admin.update_theme')->with('error', __('backend.update.error.theme_update_cancelled'));
        } else {
            try {
                $zipper = new Madzipper();
                $zipper->make(public_path() . '/updates/' . $file_name)->extractTo(base_path());
                File::delete('updates/'.$file_name);

                Artisan::call("config:clear");
                Artisan::call("migrate");
                Artisan::call('db:seed', ['class' => 'AddMissingTranslationsSeeder']);
//                exec('cd ' . base_path() . '/ && composer install');

                exec('cd ' . base_path() . '/ && composer du');

                unlink(base_path() . '/bootstrap/cache/packages.php');
                unlink(base_path() . '/bootstrap/cache/services.php');
                return redirect()->route('admin.update_theme')->with('success', __('global.flash_message.data_updated_successfully'));
            } catch (\Exception $e) {
                return redirect()->route('admin.update_theme')->with('error', 'Error updating script. ' . $e->getMessage());
            }
        }
    }
}
