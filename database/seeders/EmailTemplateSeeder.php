<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();
        $templates = [
            [
                'identifier' => 'activation_link',
                'title' => "PowerLMS Account Activation",
                'subject' => "Activate your account on PowerLMS | #DATE_TIME#",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> PowerLMS Account Activation </strong></span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Click on this “<strong><u>Activate My Account”</u></strong> button to verify your email address.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">If you did not ask to verify this address, you can ignore this email.</p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Activate My Account →</span></span></span></a></div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'reset_password',
                'title' => "Reset Password",
                'subject' => "Reset your password for PowerLMS on #DATE_TIME#",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Reset your password for PowerLMS </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Click on this “<strong><u>Reset Password</u></strong>” button to reset your password.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">If you did not ask to Reset your Password than, you can ignore this email.</p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Reset Password →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'admin_set_password_mail',
                'title' => "Set Administrator Password",
                'subject' => "Set Administrator Password | PowerLMS",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Set Administrator Password </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Click on this “<strong><u>Set Password</u></strong>” button to create Administrator password.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Set Password →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'instructor_application_approve',
                'title' => "Instructor application is accepted ",
                'subject' => "Congratulations! Your instructor application has been accepted",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Congratulations! </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Congratulations! Your instructor application for PowerLMS has been accepted by our administrator, Now you can continue creating the courses and live session for our students.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Click on below “<strong><u>Login</u></strong>” button see your dashboard.</p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Login →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'identifier' => 'instructor_application_reject',
                'title' => "Instructor application is rejected ",
                'subject' => "Sorry! Your instructor application has been rejected",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Sorry! </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Sorry! Your instructor application for PowerLMS has been rejected by our administrator.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong><u>Reason:</u></strong>#REASON#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">For more detail and assistance you can contact our customer care executive.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 15px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">You can still try again with the recommended changes.</p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Login →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'admin_create_instructor_application',
                'title' => "Instructor application submitted ",
                'subject' => "Your instructor application has been submitted to review successfully",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Your instructor application has been submitted. </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">We have received your application to become an instructor. Our Administrator will review your application and notify you about the status.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Here is your Login details!</strong></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Email : </strong> #EMAIL#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Password : </strong> #PASSWORD#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">For more detail and assistance you can contact our customer care executive.</p>
</div>
</div>
<div class="button-container" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Login →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'live_lesson_slot_details_mail',
                'title' => "Live Lesson Details",
                'subject' => "Live Lesson Details",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Your Live Lesson starts in few minutes. </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Your Live Lesson starts in few minutes.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Lesson : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Start At : </strong> #START_AT#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Meeting Id : </strong> #MEETING_ID#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Password : </strong> #PASSWORD#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Join URL : </strong> #JOIN_URL#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
</div>
</div>
<div class="button-cntainer" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#JOIN_URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Join Now →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'live_lesson_slot_reminder_mail',
                'title' => "Reminder | Your Live Lesson starts in few minutes",
                'subject' => "Reminder | Your Live Lesson starts in few minutes",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Reminder! Your Live Lesson starts in few minutes </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Reminder | Your Live Lesson starts in few minutes.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Lesson : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Start At : </strong> #START_AT#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Meeting Id : </strong> #MEETING_ID#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Password : </strong> #PASSWORD#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Join URL : </strong> #JOIN_URL#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
</div>
</div>
<div class="button-cntainer" style="padding: 25px 40px 0px 40px;" align="left"><a style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #ff1f59; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all; border: 1px solid #ff1f59;" href="#JOIN_URL#" target="_blank"><span style="padding-left: 15px; padding-right: 15px; font-size: 18px; display: inline-block; letter-spacing: undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;"><span style="font-size: 18px; line-height: 36px;">Join Now →</span></span></span></a></div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'live_lesson_slot_update_mail',
                'title' => "Your Live Lesson slot has been updated",
                'subject' => "Attention! Your Live Lesson slot has been updated",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Your Live Lesson slot has been Updated </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Attention! Your Live Lesson slot has been updated.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Updated Live Lesson Details </strong></p>
<p style="margin: 0; line-height: .8; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Lesson : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Start At : </strong> #START_AT#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Duration : </strong> #DURATION#</p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'live_lesson_slot_delete_mail',
                'title' => "Your Live Lesson has been cancelled",
                'subject' => "Attention! Your Live Lesson slot has been cancelled",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Your Live Lesson has been Cancelled </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Attention! Your Live Lesson slot has been cancelled.</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Cancelled Live Lesson Details </strong></p>
<p style="margin: 0; line-height: .8; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Lesson : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Start At : </strong> #START_AT#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Duration : </strong> #DURATION#</p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'offline_payment_request_approve_mail',
                'title' => "Approve Offline Payment Request",
                'subject' => "Attention! Your offline payment request is approved",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Approve Offline Payment Request </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Attention! Your offline payment request is approved .</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: .8; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Course Name : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Amount : </strong> #AMOUNT#</p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'offline_payment_request_reject_mail',
                'title' => "Offline Payment Request Rejected",
                'subject' => "Attention! Offline Payment Request Rejected",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Reject Offline Payment Request </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Attention! Your Offline Payment Request Rejected .</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">Your Offline payment request has been rejected. Please contact our Costomer Care service for more information.</p>
<p style="margin: 0; line-height: .8; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Course Name : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Amount : </strong> #AMOUNT#</p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'identifier' => 'payment_success_mail',
                'title' => "Your payment received successfully",
                'subject' => "Your payment received successfully",
                'content' => '<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="img-container left fixedwidth" style="padding-right: 0px; padding-left: 40px;" align="left">
<div style="font-size: 1px; line-height: 40px;"> </div>
<a style="outline: none;" tabindex="-1" target="_blank"><img class="left fixedwidth" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 175px; max-width: 100%; display: block;" title="logo" src="https://demo.powerlms.org/storage/logos/default-logo.png" alt="logo" width="120" border="0" /></a></div>
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 40px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; font-size: 34px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 51px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 34px;"><strong> Your payment received successfully </strong></span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 28px 40px 0px 40px;">
<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.5; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #0a0a0a; mso-line-height-alt: 21px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; text-align: left; font-size: 14px; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 14px;">Hey #NAME#! </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">We have received your payment towards the <strong> #TITLE#</strong>.</p>
<p style="margin: 0; line-height: .8; word-break: break-word; mso-line-height-alt: 18px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Course Name : </strong>#TITLE#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"><strong>Amount : </strong> #AMOUNT#</p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;"> </p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; mso-line-height-alt: 21px; margin-top: 0; margin-bottom: 0;">If you have any questions please do not hesitate to contact our Customer Care Service.</p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #ffffff;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="text_block" style="color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; line-height: 1.5; padding: 60px 40px 60px 40px;">
<div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #0a0a0a; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; mso-line-height-alt: 18px;">
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Thank you, </span></p>
<p style="margin: 0; line-height: 1.5; word-break: break-word; font-size: 16px; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">PowerLMS Team </span></p>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="footer-container-wrapper"> </div>
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module">
<table style="width: 100%; min-width: 100%; height: 100%; min-height: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0; text-align: center; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F3F4F8">
<tbody>
<tr>
<td style="padding: 10px 0px 0px 0px;" align="center" valign="top">
<table class="content_tablet_fullWidth" style="width: 100%; max-width: 600px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 20px 0px 16px 0px; direction: ltr;" align="center" valign="top">
<table style="max-width: 320px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/facebook.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/instagram.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/pinterest.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/twitter.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
<td style="padding: 0 8px;" align="center" valign="top"><a target="_blank" data-hs-link-id="0"><img class="footer__mobile_img" style="display: block; max-width: 35px; width: 100%;" src="https://demo.powerlms.org/frontend-assets/images/email-template/youtube.png" alt="" width="44" border="0" hspace="0" vspace="0" /></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0px 40px 60px 40px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #0a0a0a; direction: ltr;" align="center" valign="top"><span style="color: #0a0a0a !important; text-decoration: none !important;"> Miro, 201 Spear St., Suite 1100<br />San Francisco, CA 94105, United States </span><br /><br /><a style="display: inline-block; text-decoration: none !important; -webkit-text-size-adjust: none; color: #4262ff;" href="#" target="_blank" data-hs-link-id="0">Unsubscribe</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: transparent;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: transparent;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div style="border: 0px solid transparent; padding: 5px 0px 5px 0px;">
<div class="html_block" style="font-size: 16px; text-align: center; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
<div class="widget-span widget-type-custom_widget " data-widget-type="custom_widget">
<div class="layout-widget-wrapper">
<div id="hs_cos_wrapper_module_1559807911136107" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget" data-hs-cos-type="module"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color: #f3f4f8;">
<div class="block-grid " style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; margin: 0 auto; background-color: #f3f4f8;">
<div style="border-collapse: collapse; display: table; width: 100%; background-color: #f3f4f8;">
<div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
<div class="col_cont" style="width: 100% !important;">
<div> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('email_templates')->insert($templates);
    }
}
