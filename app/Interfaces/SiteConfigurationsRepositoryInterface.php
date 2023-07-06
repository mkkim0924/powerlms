<?php

namespace App\Interfaces;

interface SiteConfigurationsRepositoryInterface
{
    public function getAllConfigurationGroups();

    public function getConfigurationByIdentifier($identifier);

    public function updateConfigurations($request);

    public function updateBackupConfigurations($request);
}
