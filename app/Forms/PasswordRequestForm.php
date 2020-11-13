<?php

namespace App\Forms;

use App\AbstractForm;

class PasswordRequestForm extends AbstractForm
{
    public function buildForm()
    {

        $this
            ->add('token','hidden')
            ->add('email', 'email',[
                'template' => 'laravel-form-builder::text-inline',
                'label_show'=>false
            ])->add('password', 'password',[
                'template' => 'laravel-form-builder::text-inline',
                'label_show'=>false
            ])->add('password_confirmation', 'password',[
                'template' => 'laravel-form-builder::text-inline',
                'label_show'=>false
            ])
            ->addSubmit('',[
                'template' => 'laravel-form-builder::button-inline'
            ]);

        parent::buildForm();
    }


}
