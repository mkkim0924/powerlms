<?php

namespace App\Interfaces;

interface AdminUserRepositoryInterface
{
    public function updateProfile($request);

    public function getAllAdminNames();

    public function getAllAdmins($request);

    public function storeAdmin($request);

    public function getAdminDetail($id);

    public function updateAdmin($request, $id);

    public function getByActivationToken($token);

    public function getRoleType();

    public function updateActiveStatus($request);


}
