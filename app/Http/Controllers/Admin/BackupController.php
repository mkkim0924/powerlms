<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\SiteConfigurationsRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    protected $siteConfigurationsRepository;

    public function __construct(SiteConfigurationsRepositoryInterface $siteConfigurationsRepository)
    {
        $this->siteConfigurationsRepository = $siteConfigurationsRepository;
    }

    public function index()
    {
        return view('admin.configurations.backup');
    }

    public function updateSettings(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->siteConfigurationsRepository->updateBackupConfigurations($request);
        return redirect()->back()->with(['success' => __('global.flash_message.data_updated_successfully')]);
    }
}
