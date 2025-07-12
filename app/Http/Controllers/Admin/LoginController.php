<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function login()
    {

        return view('admin.auth.login');

    } // login form page

    public function postLogin(LoginRequest $request)
    {

        $remember_me = $request->has('remember') ? true : false;

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'phone';

        $request->merge([
            $login_type => $request->input('login'),

        ]);

        if (auth()->guard('admin')->attempt($request->only($login_type, 'password'), $remember_me)) {

            toastr()->success('تم الدخول الى لوحة التحكم بنجاح');
            return redirect()->route('admin.dashboard');
        }
        toastr()->error('هناك خطأ بالبيانات');
        return redirect()->back();
    } //redirect after authentication or not

    public function logout()
    {

        auth()->guard('admin')->logout();
        toastr()->warning('تم الخروج من لوحة التحكم بنجاح');
        return redirect()->route('admin.login');
    } //logout

}
