<?php
namespace App\Interfaces;

interface BadgeRepositoryInterface
{

    public function getAllBadges();
    public function storeBadgesData($request);
    public function getBadgesDetails($id);
    public function updateBadgesData($request, $id);
    public function delete($id);
}
