<?php
namespace App\Interfaces;

interface LocaleRepositoryInterface
{
    public function getAllLocale();

    public function storeLocale($request);

    public function getLocaleDetails($id);

    public function updateLocale($request, $id);

    public function delete($id);

    // public function getLanguageTitles();

}
