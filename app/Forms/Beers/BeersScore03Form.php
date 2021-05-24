<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore03Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'CONDIÇÕES FÍSICAS DAS CHOPEIRAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'EM BOAS CONDIÇÕES DE USO'=>'EM BOAS CONDIÇÕES DE USO',
                    'CONDICÕES RAZOÁVEIS PARA O USO'=>'CONDICÕES RAZOÁVEIS PARA O USO',
                    'MÁS CONDIÇÕES DE USO'=>'MÁS CONDIÇÕES DE USO',
                ],
                'label'=>'CONDIÇÕES FÍSICAS DAS CHOPEIRAS',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
