<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmailTemplatesRepositoryInterface;
use Illuminate\Http\Request;

class EmailTemplatesController extends Controller
{
    protected $emailTemplatesRepository;

    public function __construct(EmailTemplatesRepositoryInterface $emailTemplatesRepository)
    {
        $this->emailTemplatesRepository = $emailTemplatesRepository;
    }

    public function index(Request $request)
    {
        $email_templates = $this->emailTemplatesRepository->getAllEmailTemplates($request);
        return view('admin.email-templates.index', compact('email_templates'));
    }

    public function create(Request $request)
    {
        $identifiers = $this->emailTemplatesRepository->getEmailIdentifierTitles($request, null);
        return view('admin.email-templates.create', compact('identifiers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => "required",
            'subject' => "required",
            'identifier' => "required",
            'content' => "required",
        ]);
        $this->emailTemplatesRepository->storeEmailTemplate($request);
        return redirect()->route('admin.email-templates')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id, Request $request)
    {
        $email_template = $this->emailTemplatesRepository->getEmailTemplateDetail($id);
        $identifiers = $this->emailTemplatesRepository->getEmailIdentifierTitles($request, $id);
        return view('admin.email-templates.edit', compact('email_template', 'identifiers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => "required",
            'subject' => "required",
            'content' => "required",
        ]);
        $this->emailTemplatesRepository->updateEmailTemplate($request, $id);
        return redirect()->route('admin.email-templates')->with('success', __('global.flash_message.data_updated_successfully'));
    }
}
