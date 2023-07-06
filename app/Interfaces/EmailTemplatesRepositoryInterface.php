<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:53 PM
 */

namespace App\Interfaces;

interface EmailTemplatesRepositoryInterface
{
    public function getAllEmailTemplates($request);

    public function getEmailIdentifierTitles($request, $id = null);

    public function storeEmailTemplate($request);

    public function getEmailTemplateDetail($id);

    public function updateEmailTemplate($request, $id);

}
