<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfigurationGroup extends Model
{
    const GENERAL_GROUP = 1;
    const LAYOUT_GROUP = 2;
    const LOGO_GROUP = 3;
    const MAIL_SETTINGS_GROUP = 4;
    const LANGUAGE_GROUP = 5;
    const PAYMENT_SETTINGS_GROUP = 6;
    const SOCIAL_SETTINGS_GROUP = 7;
    const SEO_INFO_GROUP = 8;
    protected $table = 'site_configuration_groups';
    protected $fillable = ['id', 'title'];

    /* RELATIONSHIPS */
    public function siteConfigurations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SiteConfiguration::class, 'config_group_id', 'id')->whereNull('parent_config_id');
    }
}
