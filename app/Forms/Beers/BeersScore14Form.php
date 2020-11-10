<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore14Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'ORGANIZAÇÃO CAMARA FRIA, RODIZIO DE BARRIS POR DATA DE VALIDADE',
            ])
            ->add('selected', 'choice',[
                'choices'=>[
                    'ACEITÁVEL'=>'ACEITÁVEL',
                    'RAZOAVEL'=>'RAZOAVEL',
                    'NÃO ACEITÁVEL'=>'NÃO ACEITÁVEL',
                ],
                'label'=>'Organização Camara Fria, Rodizio De Barris Por Data De Validade',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }

}
