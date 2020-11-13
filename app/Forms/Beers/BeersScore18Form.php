<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore18Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'DEVOLUÇÃO DE VASILHAMES EM RELAÇÃO A ÚLTIMA ENTREGA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'DEVOLUÇÃO É FEITA 100 % EM CADA ENTREGA'=>'DEVOLUÇÃO É FEITA 100 % EM CADA ENTREGA',
                    'É FEITA DEVOLUÇÃO PARCIAL GERALMENTE'=>'É FEITA DEVOLUÇÃO PARCIAL GERALMENTE'
                ],
                'label'=>'DEVOLUÇÃO DE VASILHAMES EM RELAÇÃO A ÚLTIMA ENTREGA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
