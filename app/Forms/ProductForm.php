<?php

namespace App\Forms;

use App\AbstractForm;

class ProductForm extends AbstractForm
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
            ->add('price', 'text',
                [
                    'label'=>'Preço',
                    "attr"=>[
                        "class"=>"real form-control  form-control-rounded"
                    ]
                ]
            )->add('stock', 'text',
                [
                    'label'=>'Estoque'
                ]
            )
            ->add('liters', 'text',
                [
                    'label'=>'Litragem'
                ]
            ) ->add('und', 'text',
                [
                    'default_value'=>'1',
                    'label'=>'Unidade'
                ]
            )
            ->add('cover', 'file',
                [
                    'label'=>'Imagem'
                ]
            )
            ->addDescription()
            ->getStatus()
            ->addSubmit();

        parent::buildForm();
    }
}
