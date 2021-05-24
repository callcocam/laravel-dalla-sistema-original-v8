<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore09Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'PLANO DE MARKETING NAS REDES SOCIAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'MARKETING BEM ELABORADO DENTRO DOS PADRÕES DA DALLA CERVEJARIA'=>'MARKETING BEM ELABORADO DENTRO DOS PADRÕES DA DALLA CERVEJARIA',
                    'MARKETING ELABORADO SEM OS PADRÕES DALLA CERVEJARIA'=>'MARKETING ELABORADO SEM OS PADRÕES DALLA CERVEJARIA',
                    'MARKETING A SER ELABORADO POSTERIORMENTE'=>'MARKETING A SER ELABORADO POSTERIORMENTE',
                ],
                'label'=>'PLANO DE MARKETING NAS REDES SOCIAS (FACEBOOK, INSTA)',
                'expanded'=>true,
            ])
            ->add('date_option', 'date',[
                'label'=>'Data',
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
