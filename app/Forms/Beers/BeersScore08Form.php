<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore08Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'APRESENTAÇÃO DOS FUNCIONÁRIOS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM APRESENTÁVEIS COM UNIFORME PADRÃO'=>'BEM APRESENTÁVEIS COM UNIFORME PADRÃO',
                    'APRESENTAÇÃO MISTA'=>'APRESENTAÇÃO MISTA',
                    'APRESENTACAO COM NECESSIDADE DE MELHORIAS'=>'APRESENTACAO COM NECESSIDADE DE MELHORIAS',
                ],
                'label'=>'APRESENTAÇÃO DOS FUNCIONÁRIOS',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
