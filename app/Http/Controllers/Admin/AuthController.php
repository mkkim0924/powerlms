<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->guard('admins')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->guard('admins')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', __('backend.auth.error.invalid_credentials'));
        }
    }

    public function logout()
    {
        Auth::guard('admins')->logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}
