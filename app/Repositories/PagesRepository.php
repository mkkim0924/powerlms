<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:43 PM
 */

namespace App\Repositories;

use App\Interfaces\PagesRepositoryInterface;
use App\Models\Pages;

class PagesRepository implements PagesRepositoryInterface
{
    public function getAllPages()
    {
        return Pages::orderBy('id', 'DESC')->get();
    }

    public function storePage($request)
    {
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'pages');
        }
        Pages::create($requestData);
        return true;
    }

    public function updatePage($request, $id)
    {
        $requestData = $request->all();
        $page = self::getPagesDetails($id);
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'pages', $page->image);
        }
        $page->update($requestData);
        return true;
    }

    public function getPagesDetails($id)
    {
        return Pages::where('id', $id)->first();
    }

    public function delete($id)
    {
        Pages::destroy($id);
        return true;
    }
}
