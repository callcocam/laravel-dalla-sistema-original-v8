<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore16Form extends AbstractForm
{



    public function buildForm()
    {
        $this->add('name', 'hidden',[
                'value' => 'DA ENTREGA DOS PRODUTOS DALLA',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'SEMPRE DE ACORDO COM O PEDIDO'=>'SEMPRE DE ACORDO COM O PEDIDO',
                    'GERALMENTE DE ACORDO COM O PEDIDO'=>'GERALMENTE DE ACORDO COM O PEDIDO',
                    'RARAMENTE DE ACORDO COM O PEDIDO'=>'RARAMENTE DE ACORDO COM O PEDIDO',
                ],
                'label'=>'DA ENTREGA DOS PRODUTOS DALLA',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
