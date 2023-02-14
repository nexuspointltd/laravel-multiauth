<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Bitfumes\Multiauth\Model\Admin;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {

        return view('multiauth::admin.passwords.email');
    }

    /**
     * @return mixed
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    // public function sendResetLinkEmail(Request $request)
    // {


    //     $this->validateEmail($request);

    //     // Stores New Password
    //     $password = generate_password();

    //     //Sends email to the user with the currect password
    //     Mail::to($request->email)->send(new ResetPassword($password));

    //     //Updates Password
    //     $admin = Admin::where('email', $request->email)->first();

    //     $admin->password = bcrypt($password);
    //     $admin->password_changed_at = Carbon::now()->toDateTimeString();
    //     $admin->save();

    //     //Logs user out
    //     Auth::logout();

    //     //Redirects to login page
    //     return redirect()->route('admin')->with('success', 'Password changed successfully');

    // }

    /**
     * @param Request $request
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}
