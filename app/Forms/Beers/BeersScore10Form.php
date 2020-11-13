<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore10Form extends AbstractForm
{



    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'IDENTIFICAÇÃO DAS CHOPEIRAS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'BEM IDENTIFICADAS COM DIVULGAÇÃO DA EMPRESA E CONTATOS'=>'BEM IDENTIFICADAS COM DIVULGAÇÃO DA EMPRESA E CONTATOS',
                    'NÃO IDENTIFICADAS'=>'NÃO IDENTIFICADAS',
                    'IDENTIFICAÇÃO A SER REALIZADA NOS PRÓXIMOS DIAS'=>'IDENTIFICAÇÃO A SER REALIZADA NOS PRÓXIMOS DIAS',
                ],
                'label'=>'IDENTIFICAÇÃO DAS CHOPEIRAS',
                'expanded'=>true,
            ])
            ->add('date_option', 'date',[
                'label'=>'Data Prevista',
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
