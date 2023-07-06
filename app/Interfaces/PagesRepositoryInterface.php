<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:43 PM
 */

namespace App\Interfaces;

interface PagesRepositoryInterface
{
    public function getAllPages();

    public function storePage($request);

    public function getPagesDetails($id);

    public function updatePage($request, $id);

    public function delete($id);

}
