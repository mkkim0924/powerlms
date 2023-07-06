<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:53 PM
 */

namespace App\Repositories;

use App\Interfaces\EmailTemplatesRepositoryInterface;
use App\Models\EmailTemplates;

class EmailTemplatesRepository implements EmailTemplatesRepositoryInterface
{
    public function getAllEmailTemplates($request)
    {
        return EmailTemplates::get();
    }

    public function getEmailIdentifierTitles($request,$id = null)
    {
        $titles = [];
        $exist_record_actions = EmailTemplates::whereNotNull('id');
        if (isset($id)) {
            $exist_record_actions = $exist_record_actions->where('id', '!=', $id);
        }
        $exist_record_actions = $exist_record_actions->pluck('identifier')->toArray();
        $actions = EmailTemplates::EMAIL_ACTION;
        foreach ($actions as $key => $value) {
            if (!in_array($key, $exist_record_actions)) {
                $titles[$key] = __('backend.email_action.'.$key);
            }
        }
        return $titles;
    }

    public function storeEmailTemplate($request)
    {
        $requestData = $request->all();
        if (isset($requestData['attachment'])) {
            $requestData['attachment'] = uploadFile($requestData['attachment'], 'email-attachments');
        }
        $requestData['content'] = str_replace(['%23'], ['#'], $requestData['content']);
        EmailTemplates::create($requestData);
        return true;
    }

    public function getEmailTemplateDetail($id)
    {
        return EmailTemplates::where('id', $id)->first();
    }

    public function updateEmailTemplate($request, $id): bool
    {
        $requestData = $request->all();
        $email_template = self::getEmailTemplateDetail($id);
        if (isset($email_template)) {
            if (isset($requestData['attachment'])) {
                $requestData['attachment'] = uploadFile($requestData['attachment'], 'email-attachments', $email_template->attachment);
            } elseif (!isset($requestData['attachment']) && ($requestData['remove_attachment'] == "true") && isset($email_template->attachment)) {
                $requestData['attachment'] = null;
            }
            $requestData['content'] = str_replace(['%23'], ['#'], $requestData['content']);
            $email_template->update($requestData);
        }
        return true;
    }
}
