<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore17Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'EQUIPE DE ENTREGA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'PONTUAL E ATENCIOSO NA ENTREGA'=>'PONTUAL E ATENCIOSO NA ENTREGA',
                    'NÃO PONTUAL'=>'NÃO PONTUAL',
                    'NÃO PONTUAL, MAS ATENCIOSO'=>'NÃO PONTUAL, MAS ATENCIOSO',
                    'NÃO PONTUAL E NEM ATENCIOSO NA ENTREGA'=>'NÃO PONTUAL E NEM ATENCIOSO NA ENTREGA',
                    'COM INTERRESSE EM AJUDAR O DISTRIBUIDOR'=>'COM INTERRESSE EM AJUDAR O DISTRIBUIDOR',
                    'SEM INTERRESSE EM AJUDAR O DISTRIBUIDOR'=>'SEM INTERRESSE EM AJUDAR O DISTRIBUIDOR',
                ],
                'label'=>'EQUIPE DE ENTREGA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
