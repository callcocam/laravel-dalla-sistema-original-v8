<?php

namespace App\Forms;

use App\AbstractForm;

class DownloadForm extends AbstractForm
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
            ->add('file', 'file',
                [
                    'label'=>'Selecione um arquivo'
                ]
            )
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }
}
