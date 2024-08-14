<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {;
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => ['required', 'string',  'max:255'],
            'password' => [
                'required',
                'min:8',
            ],
        ]);

        if (auth()->attempt(['username' => $input['username'], 'password' => $input['password']]) || auth()->attempt(['email' => $input['username'], 'password' => $input['password']])) {
            return redirect()->route('home')->with('success', 'Login Berhasil, ' . auth()->user()->name . ' Selamat Datang');
        } else {
            return redirect()->route('login')->withErrors('Username atau Password Salah.');
        }
    }
}
