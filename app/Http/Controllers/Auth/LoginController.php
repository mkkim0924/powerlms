<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistrationEvent;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\User;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

// use function PHPSTORM_META\type;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'loginRedirection']);
    }

    public function loginRedirection(Request $request)
    {
        $requestData = $request->all();
        if (isset($requestData['user'])){
            if ($requestData['user'] == 'admin'){
                Auth::guard('admins')->loginUsingId(1);
                return redirect()->route('admin.dashboard');
            }elseif ($requestData['user'] == 'instructor'){
                $id = $requestData['instructor_id'] ?? 1;
                Auth::loginUsingId($id);
                return redirect()->route('instructor.dashboard');
            }elseif ($requestData['user'] == 'student'){
                Auth::loginUsingId(5);
                return redirect()->route('home');
            }
        }
        return redirect()->route('home');
    }

    public function login()
    {
        if (auth()->check()){
            return redirect()->route('home');
        }
        $previous_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        $routeTextArr = explode('.', $previous_route);
        if (in_array($previous_route, ['course_detail', 'webinar_detail', 'bundle_detail']) || ($routeTextArr[0] == 'forum')){
            session(['url.intended' => URL::previous()]);
        }
        return view('auth.login');
    }

    public function authenticateUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
            'g-recaptcha-response' => (config('services.no-captcha.active') ? ['required',new CaptchaRule] : ''),
        ],[
            'g-recaptcha-response.required' => 'Captcha required',
        ]);
        $user = User::where('email', $request['email'])->first();
        if (empty($user)) {
            return redirect()->route('login')
                ->with('error', __('backend.login.error.email_address_and_password_are_wrong'));
        }
        if ($user->is_active == 0) {
            $date = formatDate($user->created_at, "d-m-Y");
            return redirect()->route('login')
                ->with('error', __('backend.login.error.you_have_not_activated_your', ['date' => $date]));
        }
        if ($user->instructor_application_status == 2) {
            return redirect()->route('login')
                ->with('error', __('backend.login.error.your_application_was_rejected'));
        }
        if (auth()->attempt(array('email' => $request['email'], 'password' => $request['password']))) {
            if (session()->has('url.intended')){
                $url = session()->get('url.intended');
                session(['url.intended' => null]);
                return redirect()->to($url);
            }
            if ($user->type == 1) {
                return redirect()->route('instructor.dashboard');
            }
            return redirect()->route('home');
        } else {
            return redirect()->route('login')
                ->with('error', __('backend.login.error.email_address_and_password_are_wrong'));
        }
    }

    public function storeUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        try{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'g-recaptcha-response' => (config('services.no-captcha.active') ? ['required',new CaptchaRule] : ''),
            ],[
                'g-recaptcha-response.required' => 'Captcha required',
            ]);
            $requestData = $request->all();
            $requestData['type'] = isset($requestData['is_instructor']) ? 1 : 0;
            $requestData['instructor_application_status'] = (config('enable_instructor_application_review') == 1) ? 0 : 1;
            $requestData['activation_token'] = str_random(20);
            $requestData['intended_url'] = session()->get('url.intended') ?? null;
            $user = User::create($requestData);
            $admin = Admins::where('email', '=', $requestData['email'])->first();
            if (isset($admin)) {
                $admin->update(['instructor_id' => $user['id']]);
            }
            event(new UserRegistrationEvent($user));
            DB::commit();
            return redirect()->back()->with(['success' =>  __('backend.login.flash_message.please_confirm_your_account')]);
        }catch (\Exception $e){
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    public function activateUser($token): \Illuminate\Http\RedirectResponse
    {
        $user = User::where('activation_token', $token)->first();
        if (isset($user)) {
            $user->update([
                'is_active' => 1,
                'activation_token' => null,
                'email_verified_at' => Carbon::now(),
            ]);
            Auth::loginUsingId($user->id);
            if ($user->type == 1) {
                return redirect()->route('instructor.dashboard');
            }
            if ($user->intended_url != null){
                return redirect()->to($user->intended_url);
            }
            return redirect()->route('courses');
        } else {
            return redirect()->route('login')->with(['error' =>  __('backend.login.error.link_was_expired')]);
        }
    }

    public function logout()
    {
        \auth()->logout();
        return redirect()->route('home');
    }

    public function redirectToSocialProvider($provider): \Symfony\Component\HttpFoundation\RedirectResponse | \Illuminate\Http\RedirectResponse
    {
        session(['url.intended' => URL::previous()]);
        return Socialite::driver($provider)->redirect();
    }

    public function handleSocialProviderCallback($provider): \Illuminate\Http\RedirectResponse
    {
        try{
            $user = Socialite::driver($provider)->stateless()->user();
            if (isset($user->email)){
                $userExist = User::where('email', $user->email)->first();
                if (empty($userExist)) {
                    $userExist = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => null,
                        'type' => 0,
                        'is_active' => 1,
                    ]);
                }
                Auth::loginUsingId($userExist->id);
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->with('error', 'Email not available');
            }
        }catch (\Exception $e){
            return redirect()->route('login');
        }
    }
}
