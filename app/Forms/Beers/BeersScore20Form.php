<?php

namespace App\Forms\Beers;

use App\AbstractForm;
use App\Model\Admin\Task;
use App\Suports\Shinobi\Models\Permission;

class BeersScore20Form extends AbstractForm
{

    public function buildForm()
    {

        $this->add('name', 'hidden',[
                'value' => 'NA ENTREGA DOS BARRIS',
            ])
           ->add('selected', 'choice',[
                'choices'=>[
                    'VEM REFRIGERADO '=>'VEM REFRIGERADO ',
                    'NÃO VEM REFRIGERADO'=>'NÃO VEM REFRIGERADO',
                    'OS BARRÍS ESTÃO IDENTIFICADOS CORRETAMENTE'=>'OS BARRÍS ESTÃO IDENTIFICADOS CORRETAMENTE',
                    'OS BARRÍS NÃO VEM IDENTIFICADOS CORRETAMENTE'=>'OS BARRÍS NÃO VEM IDENTIFICADOS CORRETAMENTE',
                    'LACRES SEMPRE ESTÃO DEVIDAMENTE COLOCADOS'=>'LACRES SEMPRE ESTÃO DEVIDAMENTE COLOCADOS',
                    'LACRES AS VEZES ROMPIDOS'=>'LACRES AS VEZES ROMPIDOS',
                ],
                'label'=>'NA ENTREGA DOS BARRIS',
                'expanded'=>true,
            ])
            ->addDescription('description','Observações',[
                'rows'=>'3'
            ]);

        parent::buildForm();

    }


}
