<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // protected $username;

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
        // $this->username = 'username';
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        // $login = request()->input('username');
        // $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // request()->merge([$field => $login]);
        return 'username';
    }


    public function postLogin(Request $request)
    {

        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'LAS CREDENCIALES PROPORCIONADAS NO COINCIDEN CON NUESTROS REGISTROS.',
        ])->onlyInput('username');
    }
}
