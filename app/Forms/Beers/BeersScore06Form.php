<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore06Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'ORGANIZAÇÃO DO AMBIENTE DE TRABALHO',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM ORGANIZADO'=>'BEM ORGANIZADO',
                    'REGULAR'=>'REGULAR',
                    'MAL ORGANIZADO'=>'MAL ORGANIZADO',
                ],
                'label'=>'ORGANIZAÇÃO DO AMBIENTE DE TRABALHO',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
