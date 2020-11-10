<?php

namespace App\Http\Controllers\Auth;

use App\Forms\Core\FormBuilder;
use App\Forms\LoginForm;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FormBuilder $formBuilder)
    {
        $this->middleware('guest')->except('logout');
        $this->formBuilder = $formBuilder;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $form = $this->formBuilder->create(LoginForm::class, [
            'method' => 'POST',
            'url' => route('login')
        ]);

        return view('auth.login',compact("form"));
    }
}
