<?php

namespace App\Forms;

use App\AbstractForm;

class PontosForm extends AbstractForm
{
    public function buildForm()
    {
        $this
            ->add('score_meta', 'text',
                [
                    'label'=>'A cada x em compras'
                ]
                )
            ->add('score_amount', 'text',
                [
                    'label'=>'Ganha X ponto(s)'
                ])
            ->add('score_price', 'text',
                [
                    'label'=>'Valor de 1 ponto'
                ]);

        parent::buildForm();
    }
}
