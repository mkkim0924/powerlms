<?php

namespace App\Interfaces;

interface AdminUserRoleRepositoryInterface
{
    public function getAdminModules();

    public function storeAllData($request);

    public function getAllUserRole();

    public function getAdminRoleDetails($id);

    public function getSelectedModule($id);

    public function updateAdminModule($request, $id);

    public function getRoleTitles();

}
