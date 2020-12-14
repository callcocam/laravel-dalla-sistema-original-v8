<?php

namespace App\Forms;

use App\AbstractForm;

class PostForm extends AbstractForm
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
            ->add('cover', 'file',
                [
                    'label'=>'Imagem'
                ]
            ) ->add('published_up', 'date',
                [
                    'label'=>'Publicar em'
                ]
            )->add('published_down', 'date',
                [
                    'label'=>'Desplublicar em'
                ]
            )
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }
}
