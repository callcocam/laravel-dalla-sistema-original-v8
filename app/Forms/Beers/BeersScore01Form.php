<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore01Form extends AbstractForm
{



    public function buildForm()
    {



        $this->add('name', 'hidden',[
                'value' => 'ARMAZENAMENTO DAS CHOPEIRAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM ARMAZENADAS'=>'BEM ARMAZENADAS',
                    'ARMAZENAMENTO INCORRETO'=>'ARMAZENAMENTO INCORRETO',
                ],
                'label'=>'ARMAZENAMENTO DAS CHOPEIRAS',
                'expanded'=>true,
               'attr'=>[
                   'value'=>$this->getData('selected'),
               ]

            ])
            ->addDescription('description','Observações',[
                'rows'=>'3',
                'value'=>$this->getData('description'),
            ]);

        parent::buildForm();

    }


}
