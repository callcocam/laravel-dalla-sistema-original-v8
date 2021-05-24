<?php

namespace App\Http\Controllers\Auth;

use App\Forms\Core\FormBuilder;
use App\Forms\PasswordRequestForm;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * @var FormBuilder
     */
    private $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        $form = $this->formBuilder->create(PasswordRequestForm::class, [
            'method' => 'POST',
            'url' => route('password.update')
        ]);
        $form->email->setValue($request->query('email'));
        return view('auth.passwords.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'form' => $form
            ]
        );
    }
}
