<?php

namespace App\Repositories;

use App\Interfaces\SiteConfigurationsRepositoryInterface;
use App\Models\Locale;
use App\Models\SiteConfiguration;
use App\Models\SiteConfigurationGroup;
use App\Models\User;
use App\Services\NotificationService;

class SiteConfigurationsRepository implements SiteConfigurationsRepositoryInterface
{
    public function getAllConfigurationGroups(): \Illuminate\Database\Eloquent\Collection|array
    {
        return SiteConfigurationGroup::with(['siteConfigurations.childConfigurations'])->get();
    }

    public function getConfigurationByIdentifier($identifier)
    {
        return SiteConfiguration::where('identifier', $identifier)
            ->select('id', 'configuration_value', 'identifier')
            ->first();
    }

    public function updateConfigurations($request): bool
    {
        if (!file_exists(public_path('storage/logos'))) {
            mkdir(public_path('storage/logos'), 0777);
        }
        if (isset($request->configuration_value)) {
            $requestData = $request->configuration_value;
            if (isset($requestData['front_home_layout'])){
                if (isset($requestData['layout_sections_get'])){
                    $requestData['layout_sections'] = json_encode(array_keys($requestData['layout_sections'] ?? []));
                }else{
                    $requestData['layout_sections'] = json_encode(SiteConfiguration::SECTIONS[$requestData['front_home_layout']]);
                }
            }
            $switchInputs = [];
            if ($request->tab == SiteConfigurationGroup::PAYMENT_SETTINGS_GROUP){
                $switchInputs = ['services.stripe.active', 'services.razorpay.active', 'services.paypal.active', 'services.payu.active', 'offline_payment.active'];
            }elseif ($request->tab == SiteConfigurationGroup::GENERAL_GROUP){
                $switchInputs = ['services.no-captcha.active', 'enable_instructor_application_review', 'enable_course_review','disable_instructor_registration'];
            }elseif ($request->tab == SiteConfigurationGroup::SOCIAL_SETTINGS_GROUP){
                $switchInputs = ['services.google.active', 'services.facebook.active'];
            }
            foreach ($switchInputs as $switchInput) {
                $requestData[$switchInput] = isset($requestData[$switchInput]) ? 1 : 0;
            }
            unset($requestData['layout_sections_get']);
            $notificationService = new NotificationService();
            foreach ($requestData as $key => $value) {
                $configuration = self::getConfigurationByIdentifier($key);
                if ($request->hasFile("configuration_value." . $key)) {
                    $value = uploadFile($value, 'logos/', $configuration->configuration_value);
                }
                $configuration->update(['configuration_value' => $value]);

                if($key === 'app.locale'){
                    Locale::where('short_name','!=',$value)->update(['is_default' => 0]);
                    Locale::where('short_name',$value)->update(['is_default' => 1]);
                }elseif ($key == 'system_revenue_percentage' && ($value != $configuration->configuration_value)){
                    $instructors = User::where('type', 1)->where('custom_payout_setting_enable', 0)->get();
                    foreach ($instructors as $instructor){
                        $notificationService->store(
                            $instructor->id,
                            'admin_update_system_revenue',
                            ['revenue' => $value]
                        );
                    }
                }
            }
        }
        return true;
    }

    public function updateBackupConfigurations($request): bool
    {
        $requestData = $request->except('_token');
        SiteConfiguration::where('identifier', 'backup.status')->update(['configuration_value' => isset($requestData['backup_status']) ? 1 : 0]);
        unset($requestData['backup_status']);
        foreach ($requestData as $key => $value){
            SiteConfiguration::where('identifier', str_replace('_', '.', $key))->update(['configuration_value' => $value]);
        }
        return true;
    }
}
