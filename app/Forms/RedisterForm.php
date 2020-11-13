<?php

namespace App\Forms;

use App\AbstractForm;

class RedisterForm extends AbstractForm
{
    public function buildForm()
    {

        $this->add('name', 'text',[
            'template' => 'laravel-form-builder::text-inline',
            'label_show'=>false
        ])->add('email', 'email',[
            'template' => 'laravel-form-builder::text-inline',
            'label_show'=>false
        ])
            ->add('password', 'password',[
                'template' => 'laravel-form-builder::text-inline',
                'label_show'=>false
            ])->add('password_confirmation', 'password',[
                'template' => 'laravel-form-builder::text-inline',
                'label_show'=>false
            ])
            ->addSubmit('Register',[
                'template' => 'laravel-form-builder::button-inline'
            ]);

        parent::buildForm();
    }


}
