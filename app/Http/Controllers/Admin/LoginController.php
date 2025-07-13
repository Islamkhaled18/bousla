<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {

        return view('admin.auth.login');

    } // login form page

    public function postLogin(LoginRequest $request)
    {

        $login      = $request->input('login');
        $login_type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $remember_me = $request->has('remember');

        $request->merge([
            $login_type => $login,
        ]);

        $key = 'admin-login:' . Str::lower($login);

        $admin = Admin::where($login_type, $login)->first();

        if ($admin && $admin->suspended) {
            toastr()->error('تم إيقاف الحساب من قبل النظام بعد محاولات دخول فاشلة.');
            return redirect()->back();
        }

        if (RateLimiter::tooManyAttempts($key, 5)) {

            if ($admin) {
                $admin->suspended = true;
                $admin->save();
            }

            toastr()->error('تم إيقاف الحساب مؤقتًا بعد محاولات دخول فاشلة.');
            return redirect()->back();
        }

        if (auth()->guard('admin')->attempt($request->only($login_type, 'password'), $remember_me)) {

            // ✅ Clear rate limiter on success
            RateLimiter::clear($key);

            toastr()->success('تم الدخول إلى لوحة التحكم بنجاح');
            return redirect()->route('admin.dashboard');
        }

                                     // ✅ Failed attempt → increment rate limit counter
        RateLimiter::hit($key, 120); // block duration = 2 minutes

        toastr()->error('هناك خطأ في البيانات، حاول مرة أخرى.');
        return redirect()->back();
    } //redirect after authentication or not

    public function logout()
    {

        auth()->guard('admin')->logout();
        toastr()->warning('تم الخروج من لوحة التحكم بنجاح');
        return redirect()->route('admin.login');
    } //logout

}
