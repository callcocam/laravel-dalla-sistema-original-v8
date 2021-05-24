<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore12Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'LIMPEZA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'ACEITÁVEL '=>'ACEITÁVEL ',
                    'RAZOAVEL'=>'RAZOAVEL',
                    'NÃO ACEITÁVEL'=>'NÃO ACEITÁVEL',
                ],
                'label'=>'LIMPEZA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
