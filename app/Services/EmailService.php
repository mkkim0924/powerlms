<?php
/**
 * Created by PhpStorm.
 * User: ombharti
 * Date: 1/2/2018
 * Time: 5:03 PM
 */

namespace App\Services;

use App\Models\EmailTemplates;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class EmailService
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->from = config('mail.from.address');
        $this->from_name = config('mail.from.name');
        $this->mailer = $mailer;
    }

    public function sendEmail($mail_params_array, $template = null, $dynamic_data = null)
    {
        $to = $mail_params_array['to'];
        $result = null;
        if (is_array($to)) {
            foreach ($mail_params_array['to'] as $user_email) {
                $result = self::sendEmailToUser($user_email, $template, $dynamic_data);
            }
        } else {
            $result = self::sendEmailToUser($to, $template, $dynamic_data);
        }
        return $result;
    }

    public function sendEmailToUser($to, $template = null, $dynamic_data = null): bool|string
    {
        $template_variables = Config::get('emailvariables.' . $template);
        $replace_array = $key_array = [];
        if (!empty($template_variables)) {
            foreach ($template_variables as $key => $template_variable) {
                $key_array[] = "#" . $key . "#";
                $replace_array[] = (isset($dynamic_data[trim($key, '#')])) ? $dynamic_data[trim($key, '#')] : '';
            }
        }
        $email_data = null;
        if (!is_null($template)) {
            $email_data = EmailTemplates::where('identifier', $template)->first();
        }
        if (isset($email_data)) {
            $file_path = isset($email_data->attachment) ? getFileUrl($email_data->attachment, 'email-attachments') : null;
            $subject = str_replace($key_array, $replace_array, $email_data['subject']);
            $content = str_replace($key_array, $replace_array, $email_data->content);
            $content_data = ['email_content' => $content];
            try {
                Mail::send('emailsample', $content_data, function ($message) use ($to, $subject, $file_path, $template) {
                    $message->from($this->from, $this->from_name)
                        ->to($to)
                        ->subject($subject);
                    if (isset($file_path)) {
                        $message->attach($file_path);
                    }
                });
            } catch (\Exception $e) {
                return throw new RuntimeException(sprintf("Email not sent from the Emails. Returned with error: " . $e->getMessage()), $e->getCode(), $e);
            }
        }else{
            return throw new RuntimeException(sprintf("Email content not available for template: " . $template), 500);
        }
        return true;
    }
}
