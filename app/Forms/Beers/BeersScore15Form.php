<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore15Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'MATERIAIS DE DIVULGAÇÃO OFERECIDOS PELA CERVEJARIA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'ACEITÁVEL, NO QUE FOI COMBINADO'=>'ACEITÁVEL, NO QUE FOI COMBINADO',
                    'RAZOÁVEL. NO QUE FOI COMBINADO'=>'RAZOÁVEL. NO QUE FOI COMBINADO',
                    'NÃO ACEITÁVEL, NO QUE FOI COMBINADO'=>'NÃO ACEITÁVEL, NO QUE FOI COMBINADO',
                ],
                'label'=>'MATERIAIS DE DIVULGAÇÃO OFERECIDOS PELA CERVEJARIA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
