<?php

namespace App\Forms;

use App\AbstractForm;

class EmailRequestForm extends AbstractForm
{
    public function buildForm()
    {

        $this->add('email', 'email',[
            'template' => 'laravel-form-builder::text-inline',
            'label_show'=>false
        ])->addSubmit('Enviar link de recuperação de senha',[
            'template' => 'laravel-form-builder::button-inline'
        ]);

        parent::buildForm();
    }


}
