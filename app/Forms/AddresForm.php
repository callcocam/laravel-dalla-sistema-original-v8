<?php

namespace App\Forms;

use App\AbstractForm;

class AddresForm extends AbstractForm
{
    public function buildForm()
    {
        $this
            ->add('zip', 'text',
                [
                    'label'=>'Cep'
                ]
                )
            ->add('state', 'text',
                [
                    'label'=>'Estado',
                    'rules'=>'max:2'
                ])
            ->add('city', 'text',
                [
                    'label'=>'Cidade'
                ])
            ->add('district', 'text',
                [
                    'label'=>'Bairro'
                ])
            ->add('street', 'text',
                [
                    'label'=>'Rua'
                ])
            ->add('number', 'text',
                [
                    'label'=>'Número'
                ])
            ->add('complement', 'text',
                [
                    'label'=>'Complemento'
                ]);

        parent::buildForm();
    }
}
