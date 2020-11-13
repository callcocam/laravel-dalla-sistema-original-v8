<?php

namespace App\Http\Controllers\Auth;

use App\Forms\Core\FormBuilder;
use App\Forms\EmailRequestForm;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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
     * @var FormBuilder
     */
    private $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $form = $this->formBuilder->create(EmailRequestForm::class, [
            'method' => 'POST',
            'url' => route('password.email')
        ]);
        return view('auth.passwords.email', compact('form'));
    }
}
