<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendResetPasswordMailEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function submitForgetPasswordForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        try{
            $user = User::where('email', $request->email)->first();
            if (isset($user)) {
                DB::beginTransaction();
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $emailData = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                ];
                event(new SendResetPasswordMailEvent($emailData));
                DB::commit();
                return redirect()->back()->with('success', __('backend.reset_password.flash_message.we_have_e_mailed_your'));
            }
            return redirect()->back()->with('error', __('backend.reset_password.error.user_not_exists'));
        }catch (\Exception $e){
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    public function showResetPasswordForm($token): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $recordExist = DB::table('password_resets')->where(['token' => $token])->first();
        if ($recordExist) {
            return view('auth.reset_password', compact('token', 'recordExist'));
        } else {
            return redirect()->route('login')->with('error', __('backend.reset_password.error.link_expired'));
        }
    }

    public function submitResetPasswordForm(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => $request->password]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect()->route('login')->with('success', __('backend.reset_password.flash_message.your_password_has_been_changed'));
    }
}
