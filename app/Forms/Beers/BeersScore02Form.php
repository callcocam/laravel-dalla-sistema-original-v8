<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore02Form extends AbstractForm
{



    public function buildForm()
    {


        $this->add('name', 'hidden',[
                'value' => 'HIGIENIZAÇÃO E LIMPEZA DAS CHOPEIRAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'LIMPAS E HIGIENIZADAS'=>'LIMPAS E HIGIENIZADAS',
                    'LIMPAS E NÃO HIGIENIZADAS'=>'LIMPAS E NÃO HIGIENIZADAS',
                    'NÃO LIMPAS E NEM HIGIENIZADAS'=>'NÃO LIMPAS E NEM HIGIENIZADAS',
                ],
                'label'=>'HIGIENIZAÇÃO E LIMPEZA DAS CHOPEIRAS',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
