<?php

namespace App\Forms;

use App\AbstractForm;

class CategoryForm extends AbstractForm
{
    public function buildForm()
    {
        $this ->add('id', 'hidden')
            ->add('slug', 'hidden')
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
