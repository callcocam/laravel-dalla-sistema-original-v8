<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore13Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'ORGANIZAÇÃO C MARA FRIA, RODIZIO DE BARRIS POR DATA DE VALIDADE',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'ACEITÁVEL'=>'ACEITÁVEL',
                    'RAZOAVEL'=>'RAZOAVEL',
                    'NÃO ACEITÁVEL'=>'NÃO ACEITÁVEL',
                ],
                'label'=>'ORGANIZAÇÃO C MARA FRIA, RODIZIO DE BARRIS POR DATA DE VALIDADE',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
