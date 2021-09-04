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
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     //$this->middleware('guest:alumno')->except('logout');
    // }

    public function customLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($this->guard('alumno')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('alumno.home'));
        }

        $errorMsg = "Usuario y/o contraseña incorrecta, verifica tus datos";
        return back()->withInput($request->only('email', 'remember'))->with('loginFail',$errorMsg);
    }

    private function checkUserType(Request $request)
    {

    }
}
