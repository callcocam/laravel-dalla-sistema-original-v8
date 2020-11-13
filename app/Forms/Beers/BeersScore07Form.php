<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore07Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'APRESENTAÇÃO DA MARCA DALLA NA FACHADA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM APRESENTÁVEL'=>'BEM APRESENTÁVEL',
                    'APRESENTAÇÃO RAZOÁVEL'=>'APRESENTAÇÃO RAZOÁVEL',
                    'APRESENTACAO COM NECESSIDADE DE MELHORIAS'=>'APRESENTACAO COM NECESSIDADE DE MELHORIAS'
                ],
                'label'=>'APRESENTAÇÃO DA MARCA DALLA NA FACHADA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
