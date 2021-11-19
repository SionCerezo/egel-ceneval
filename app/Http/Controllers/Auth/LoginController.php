<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserHelpers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brick\Math\Exception\MathException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('guest:alumno')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        session(['fulluser' => $user->fullUser]);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return UserHelpers::userHomePath();
    }

    /**
     * @Override from AuthenticateUsers.
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ];
        $messages = ['email.exists'=> trans('passwords.user')];

        $request->validate($rules, $messages);
    }

    /**
     * @Override from AuthenticateUsers
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'password' => [trans('auth.password')],
        ]);
    }

    // private function checkUserType(Request $request)
    // {

    // }


    // public function customLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'   => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if ($this->guard('alumno')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
    //         return redirect()->intended(route('alumno.home'));
    //     }

    //     $errorMsg = "Usuario y/o contraseña incorrecta, verifica tus datos";
    //     return back()->withInput($request->only('email', 'remember'))->with('loginFail',$errorMsg);
    // }
}
