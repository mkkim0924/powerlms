<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Locale;
use App\Models\SiteConfiguration;
use Illuminate\Http\Request;
use App\Interfaces\SiteConfigurationsRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SiteConfigurationsController extends Controller
{
    protected $siteConfigurationsRepository;

    public function __construct(SiteConfigurationsRepositoryInterface $siteConfigurationsRepository)
    {
        $this->siteConfigurationsRepository = $siteConfigurationsRepository;
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $configuration_groups = $this->siteConfigurationsRepository->getAllConfigurationGroups();
        $select_configuration_values['app.locale'] = Locale::pluck('name', 'short_name')->toArray();
        $select_configuration_values['app.currency'] = Currency::select(DB::Raw('CONCAT(symbol," - ",`name`) as title'), 'short_code')->pluck('title', 'short_code')->toArray();
        $select_configuration_values['paypal.settings.mode'] = $select_configuration_values['services.payu.mode'] = [
            'sandbox' => __('backend.site_configuration.payment_mode_option.sandbox'),
            'live' => __('backend.site_configuration.payment_mode_option.live'),
        ];
        $select_configuration_values['mail.mailers.smtp.encryption'] = ['tls' => 'tls', 'ssl' => 'ssl'];
        $select_configuration_values['front_home_layout'] = [
            'layout1' => __('backend.site_configuration.layout_option.layout_prefix').' 1',
            'layout2' => __('backend.site_configuration.layout_option.layout_prefix').' 2',
            'layout3' => __('backend.site_configuration.layout_option.layout_prefix').' 3',
            'layout4' => __('backend.site_configuration.layout_option.layout_prefix').' 4',
            'layout5' => __('backend.site_configuration.layout_option.layout_prefix').' 5',
            'layout6' => __('backend.site_configuration.layout_option.layout_prefix').' 6',
            'layout7' => __('backend.site_configuration.layout_option.layout_prefix').' 7',
            'layout8' => __('backend.site_configuration.layout_option.layout_prefix').' 8',
            'layout9' => __('backend.site_configuration.layout_option.layout_prefix').' 9'
        ];
        $select_configuration_values['currency_position'] = [
            'left' => __('backend.site_configuration.currency_position_option.left'),
            'right' => __('backend.site_configuration.currency_position_option.right'),
            'left-space' => __('backend.site_configuration.currency_position_option.left_space'),
            'right-space' => __('backend.site_configuration.currency_position_option.right_space')
        ];
        return view('admin.configurations.index', compact('configuration_groups', 'select_configuration_values'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->siteConfigurationsRepository->updateConfigurations($request);
        return redirect()->route('admin.configurations')->with(['success' => __('global.flash_message.data_updated_successfully'), 'current_tab' => $request->tab]);
    }

    public function getSectionsByLayout($layout): \Illuminate\Http\JsonResponse
    {
        $sections = SiteConfiguration::SECTIONS[$layout];
        $returnHtml = view('admin.configurations.partials.sections', compact('sections'))->render();
        return response()->json(['status' => true, 'html' => $returnHtml]);
    }

    public function troubleshoot(): \Illuminate\Http\RedirectResponse
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1000);

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        shell_exec('cd '.base_path().'/public');
        shell_exec('rm storage');

        shell_exec('sudo chmod -R 777 public');
        shell_exec('sudo chmod -Rf 777 storage');
        shell_exec('sudo chmod -Rf 777 resources/lang');
        shell_exec('sudo chmod -R 777 bootstrap');
        Artisan::call('storage:link');
        return back();
    }
}
