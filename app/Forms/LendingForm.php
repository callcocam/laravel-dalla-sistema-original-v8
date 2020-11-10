<?php

namespace App\Forms;

use App\AbstractForm;

class LendingForm extends AbstractForm
{
    public function buildForm()
    {
        $this ->add('id', 'hidden')
            ->add('slug', 'hidden')
            ->add('client_id', 'hidden')
            ->add('name', 'text',
                [
                    'label'=>'Nome'
                ]
            )
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }
}
